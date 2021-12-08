<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/index.css">
    <title>My Site!</title>
  </head>
  <body>
    <div class="container">
      <h1>Guestbook</h1>
      <form class="" action="<?php $_PHP_SELF ?>" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="" />
        <br />
        <label for="email">Email:</label>
        <input type="text" name="email" value="" />
        <br />
        <label for="website">Website:</label>
        <input type="text" name="website" value="" />
        <br />
        <label for="message">Message:</label>
        <br />
        <textarea name="message" value=""></textarea>
        <br />
        <button type="submit" name="button">Submit</button>
        <br /><hr />

      </form>
      <?php
      function guestpost($time, $name, $email, $website, $message) {
        $strdate = date("l, F jS, Y g:i:s A", $time);

        // Escape HTML characters to prevent XSS
        $name = htmlspecialchars($name);
        $message = htmlspecialchars($message);

        echo "<div class=\"guestpost\">";
        echo "<p>Date: $strdate</p>";
        echo "<p>Name: $name</p>";
        if ($email != null) {
          $email = htmlspecialchars($email);
          echo "<p>Email: $email</p>";
        }
        if ($website != null) {
          $link_website = null;

          if (!str_starts_with($website, "http://") && !str_starts_with($website, "https://")) {
            $link_website = "https://" . $website;
          } else {
            $link_website = $website;
          }
          echo "<p>Website: <a href=\"$link_website\">$website</a></p>";
        }
        echo "<br />";
        echo "<p>$message</p>";
        echo "</div>";
        echo "<br />";
      }

      // Connect to database
      $db = $_ENV['MYSQL_DATABASE'];
      $conn = new PDO("mysql:host=database;dbname=$db", $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      // On POST request

      if (isset($_POST['name']) && isset($_POST['message'])) {
        $time = time();
        $name = $_POST['name'];
        $email = ($_POST['email'] == '') ? null : $_POST['email'];
        $website = ($_POST['website'] == '') ? null : $_POST['website'];
        $message = $_POST['message'];

        // Next part of the script will show the user's post.
        // TODO: Fix XSS
        $sql = "INSERT INTO messages (sent, name, email, website, message)
                VALUES (?, ?, ?, ?, ?);";

        try {
          // Safely posts data into database (prevents SQL injection)
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(1, $time, PDO::PARAM_INT); // unsigned bigint
          $stmt->bindParam(2, $name, PDO::PARAM_STR, 255); // tinytext
          $stmt->bindParam(3, $email, PDO::PARAM_STR, 255); // tinytext
          $stmt->bindParam(4, $website, PDO::PARAM_STR, 255); // tinytext
          $stmt->bindParam(5, $message, PDO::PARAM_STR, 65535); // text
          $stmt->execute();
          echo "<p>Thank you for posting $name!</p>";
        } catch (PDOException $e) {
          echo "Error: " . $sql . "<br>" . $e->getMessage();
        }
      }

      // Get all posts

      try {
        $sql = "SELECT sent, name, email, website, message FROM messages ORDER BY id DESC;";
        $result = $conn->query($sql);

        if($result !== false) {
          $cols = $result->columnCount();

          foreach($result as $row) {
            guestpost($row['sent'], $row['name'], $row['email'], $row['website'], $row['message']);
          }
        }

      } catch (PDOException $e) {
        echo "Error: " . $sql . "<br>" . $e->getMessage();
      }

      // Done
      $conn = null;
      ?>
    </div>
  </body>
</html>
