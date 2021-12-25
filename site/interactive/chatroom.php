<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/chatroom.css">
    <title>My Site!</title>
  </head>
  <body>
    <div class="container">
      <h1>Chatroom</h1>
      <div class="form">
        <div class="chat_head">
          <p>Hello, <span id="Nickname" class="chat_nickname"></span>!<button onclick="initName(true)" type="button" name="button" style="float: right;">Change nickname</button></p>
        </div>
        <div class="chat">
        </div>
        <div class="chat_foot">
          <input id="" type="text" name="chatmsg" class="chat_msg" value="">
          <button onclick="postChat()" type="button" name="button">Submit</button>
        </div>
      </div>
    </div>
    <script src="/js/chatroom.js" charset="utf-8"></script>
  </body>
</html>
