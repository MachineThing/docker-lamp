<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/index.css">
    <title>404 Not Found</title>
  </head>
  <body>
    <div class="container">
      <h1 style="margin-top: 0px;">Not Found</h1>
      <p>The requested URL was not found on this server.</p>
      <hr>
      <address><?php
      // Make this look like an actual Apache 404 page
      $version = apache_get_version();
      $host = $_SERVER['SERVER_NAME'];
      $port = $_SERVER['SERVER_PORT'];

      echo "$version Server at $host Port $port";
      ?></address>
    </div>
  </body>
</html>
