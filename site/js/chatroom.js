'use strict';

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
  var name;

  if (!skipGet) {
    name = getName();
  }

  while (name == null) {
    name = prompt("Please enter your name!");
    document.cookie = `name=${name};SameSite=lax; ${document.cookie}`;
  }

  var nickid = document.getElementById("Nickname");
  nickid.innerHTML = name;

  return name;
}

const nickname = initName();

console.log(nickname);
console.log(document.cookie);
console.log("Hello, world!");
