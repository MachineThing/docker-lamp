<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/index.css">
    <title>My Site!</title>
  </head>
  <body>
    <div class="container">
      <h1>Hello, world!</h1>
      <p><?php
      // Version
      $version = phpversion();
      echo "PHP Version: $version";

      // Newline
      echo "<br />";

      // Date
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
        <li><a href="/interactive/guestbook.php">Guestbook</a></li>
        <li><a href="/interactive/chatroom.php">Chatroom</a></li>
        <li><a href="/phpinfo.php">PHP Info</a></li>
      </ul>
    </div>
    <div class="buttons">
      <a href="https://www.debian.org" target="_blank"><img src="/static/images/debian.gif" alt="Powered by Debian"></a>
      <a href="http://www.theoldnet.com" target="_blank"><img src="/static/images/oldnet.gif" alt="The Old Net"></a>
      <a href="http://www.toastytech.com/evil" target="_blank"><img src="/static/images/ieexplode.gif" alt="ie go boom"></a>
      <a href="https://www.vim.org" target="_blank"><img src="/static/images/vim.gif" alt="I love Vim"></a>
    </div>
  </body>
</html>
