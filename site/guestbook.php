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
      <form class="" action="guestbook.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" value="" />
        <br />
        <label for="email">Email:</label>
        <input type="email" name="email" value="" />
        <br />
        <label for="website">Website:</label>
        <input type="url" name="website" value="" />
        <br />
        <label for="message">Message:</label>
        <br />
        <textarea name="message" value=""></textarea>
        <br />
        <button type="submit" name="button">Submit</button>
        <br /><br />

      </form>
      <?php
      $link=mysqli_connect("database",$_ENV['MYSQL_USER'],$_ENV['MYSQL_PASSWORD'],$_ENV['MYSQL_DATABASE'], 3306);

      if (mysqli_connect_errno()) {
        die("MySQL connecttion failed: " . mysqli_connect_error());
      } else {
        echo "Connected successfully<br />";
        echo mysqli_get_server_info($link);
      }

      mysqli_close($link);
      ?>
    </div>
  </body>
</html>
