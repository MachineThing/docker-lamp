'use strict';

var name = "";

const cDecode = decodeURIComponent(document.cookie); // To be careful getting cookie
const cArr = cDecode.split('; ');
cArr.forEach(val => {
  if (val.indexOf("name=") === 0) {
    name = val.substring(5);
  }
})

if (name == "") {
  name = prompt("Please enter your name!");
  document.cookie = `name=${name}; ${document.cookie}`;
}

var nick = document.getElementById("Nickname");
nick.innerHTML = `Hello, ${name}!`;

console.log(name);
console.log(document.cookie);
console.log("Hello, world!");
