<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/index.css">
    <title>My Site!</title>
  </head>
  <body>
    <h1>Hello, world!</h1>
    <p>Today is: <?php
      $todaydate = getdate();

      echo "$todaydate[weekday], $todaydate[month], $todaydate[mday]";

      if (str_ends_with('1', (string)$todaydate['mday'])) {
        echo "st";
      } elseif (str_ends_with('2', (string)$todaydate['mday'])) {
        echo "nd";
      } elseif (str_ends_with('3', (string)$todaydate['mday'])) {
        echo "rd";
      } else {
        echo "th";
      }

      echo ", $todaydate[year]";
      ?></p>
    <h2>Links</h2>
    <ul>
      <li><a href="/phpinfo.php">PHP Info</a></li>
    </ul>
  </body>
</html>
