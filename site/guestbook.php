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
        <br /><br />

      </form>
      <?php
      function guestpost($time, $name, $email, $website, $message) {
        $strdate = date("l, F jS, Y g:i:s A", $time);

        echo "<div class=\"guestpost\">";
        echo "<p>Date: $strdate</p>";
        echo "<p>Name: $name</p>";
        if ($email != "") {
          echo "<p>Email: $email</p>";
        }
        if ($website != "") {
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
      $link=mysqli_connect("database",$_ENV['MYSQL_USER'],$_ENV['MYSQL_PASSWORD'],$_ENV['MYSQL_DATABASE'], 3306);

      if (mysqli_connect_errno()) {
        die("MySQL connecttion failed: " . mysqli_connect_error());
      }

      // On POST request

      if (isset($_POST['name']) && isset($_POST['message'])) {
        $time = time();
        $name = $_POST['name'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $message = $_POST['message'];

        guestpost($time, $name, $email, $website, $message);
      }

      // Get all posts

      $sql = "SELECT sent, name, email, website, message FROM messages ORDER BY id";
      $result = $link->query($sql);

      if (mysqli_num_rows($result) > 0) {
        // Output data of all rows
        while ($row = mysqli_fetch_assoc($result)) {
          guestpost($row['sent'], $row['name'], $row['email'], $row['website'], $row['message']);
        }
      }

      // Done
      mysqli_close($link);
      ?>
    </div>
  </body>
</html>
