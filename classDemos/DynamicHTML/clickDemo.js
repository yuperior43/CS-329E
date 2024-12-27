function copyIt() {
  enteredString = document.getElementById("inThing").value
  document.getElementById("outThing").innerHTML = "You typed '" + enteredString + "'."
}

ptr = document.getElementById("outThing")
ptr.addEventListener("mouseover", changeBlue)
ptr.addEventListener("mouseout", changeRed)

function changeBlue(event) {
  event.target.style.color = "blue"
}

function changeRed(event) {
  event.target.style.color = "red"
}
