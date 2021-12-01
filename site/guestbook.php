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
      if (isset($_POST['name']) && isset($_POST['message'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $website = $_POST['website'];
        $message = $_POST['message'];

        $link=mysqli_connect("database",$_ENV['MYSQL_USER'],$_ENV['MYSQL_PASSWORD'],$_ENV['MYSQL_DATABASE'], 3306);

        if (mysqli_connect_errno()) {
          die("MySQL connecttion failed: " . mysqli_connect_error());
        } else {
          echo "Connected successfully<br />";
          echo mysqli_get_server_info($link);

          echo "<div class=\"guestpost\">";
          echo "<p>Name: $name</p>";
          if (isset($email)) {
            echo "<p>Email: $email</p>";
          }
          if (isset($website)) {
            if (!str_starts_with($website, "http://") && !str_starts_with($website, "https://")) {
              $website = "https://" . $website;
            }
            echo "<p>Website: <a href=\"$website\">$website</a></p>";
          }
          echo "<br />";
          echo "<p>$message</p>";
          echo "</div>";
        }

        mysqli_close($link);
      }
      ?>
    </div>
  </body>
</html>
