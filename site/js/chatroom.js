'use strict';

// Name cookies
function getName() {
  var name = null;
  const cDecode = decodeURIComponent(document.cookie); // To be careful getting cookie
  const cArr = cDecode.split('; ');
  cArr.forEach(val => {
    if (val.indexOf("name=") === 0) {
      name = val.substring(5);
    }
  })
  return name
}

function initName(skipGet=false) {
  var name = null;

  if (!skipGet) {
    name = getName();
  }

  while (name == null) {
    name = prompt("Please enter your name!");
    document.cookie = `name=${name};SameSite=lax; ${document.cookie}`;
  }

  var nickid = document.getElementById("chat_nickname");
  nickid.innerHTML = name;
  nickid.style.color = getNickColor(name);

  return name;
}

// Nickname color
function getNickColor(nickname) {
  const letters = []

  function getMagic(position) {
    const magic = 127; // 01111111
    const dec = (nickname[position].toUpperCase().charCodeAt(0)**2)&magic;
    return dec;
  }

  // First character
  letters.push(getMagic(0));
  // Middle-most character
  letters.push(getMagic(Math.floor(nickname.length/2)));
  // Last character
  letters.push(getMagic(nickname.length-1));

  const main_color = letters.reduce(function (total, num) {
    const maximum = 128;
    var reducedTotal = total + num;
    while (reducedTotal >= maximum) {
      reducedTotal -= maximum;
    }
    return reducedTotal;
  })*2;

  var dividable = main_color;
  const hex_codes = [];
  const sortedLetters = [...letters]; // Copy array
  sortedLetters.sort();
  for (const x of sortedLetters) {
    for (const y of letters) {
      if (x == y) {
        hex_codes.push(dividable.toString(16));
        break;
      } else {
        dividable = Math.floor(dividable / 2);
      }
    }
    dividable = main_color;
  }

  const hex_code = hex_codes.join("").padStart(2, "");
  return `#${hex_code}`;
}

// Actual chat stuff
function chatMsg(nick, message) {
  var chatDiv = document.getElementById("chat");
  // Make elements
  var newChatMsg = document.createElement("p");
  var newMsgNick = document.createElement("span");
  // Nickname element
  newMsgNick.className = "chat_nickname";
  newMsgNick.innerHTML = nick;
  newMsgNick.style.color = getNickColor(nick);
  // Chat message element
  newChatMsg.className = "chat_msg";
  newChatMsg.appendChild(newMsgNick); // Append nickname
  newChatMsg.innerHTML += `: ${message}`;
  chatDiv.appendChild(newChatMsg);
}

// Initiaization
const nickname = initName();
chatMsg("ChatBot", `Hello ${nickname}! Welcome to Mason\'s chatroom, please be nice to other people :)`);

function postChat() {
  const message = document.getElementById("chat_msg").value;
  if (message == "") {
    chatMsg("ChatBot", "Your message cannot be blank!");
  } else {
    chatMsg(nickname, message);
    document.getElementById("chat_msg").value = "";
    // Send message via AJAX
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4) {
        var xmlDoc = this.responseXML;
        const response = xmlDoc.getElementsByTagName("response")[0];
        if (response.attributes.code.value != "good") {
          throw response.attributes.code.value;
        }
      }
    };
    xhttp.open("POST", "/api/chat.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send(`nick=${nickname}&msg=${message}`);
  }
}

function getChat() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4) {
      var xmlDoc = this.responseXML;
      const response = xmlDoc.getElementsByTagName("response")[0];
      if (response.attributes.code.value == "good") {
        for (var msg of response.children) {
          const msg_id = msg.attributes.id;
          const msg_name = msg.attributes.name;
          const msg_msg = msg.attributes.msg;
          chatMsg(msg_name, msg_msg);
        }
        console.log(response);
      } else {
        throw response.attributes.code.value;
      }
      //chatMsg();
    }
  };
  xhttp.open("GET", "/api/chat.php", true);
  xhttp.send();
}
