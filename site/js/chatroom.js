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
  console.log(letters, sortedLetters);
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

// Initiaization
const nickname = initName();
