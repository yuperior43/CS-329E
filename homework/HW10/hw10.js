seconds = 0

function startTimer() {
    timerInterval = setInterval(updateTimer, 1000)
}

function stopTimer() {
    clearInterval(timerInterval)
    isCorrect()
}

function pad(value) {
    return value < 10 ? "0" + value : value
}

function updateTimer() {
    seconds++

    formattedTime = pad(seconds)
    document.getElementById("timer").textContent = formattedTime
}

function generateRandomPuzzle() {
    puzzleSets = ["puzzle1", "puzzle2", "puzzle3"]
    randomIndex = Math.trunc(Math.random() * puzzleSets.length)
    shownPuzzle = puzzleSets[randomIndex]

    for (i = 0; i < puzzleSets.length; i++) {
        puzzleSetClass = document.getElementsByClassName(puzzleSets[i])
        for (j = 0; j < puzzleSetClass.length; j++) {
            puzzleSetStyle = puzzleSetClass[j].style
            if (puzzleSets[i] === shownPuzzle) {
                puzzleSetStyle.display = "block"
            } else {
                puzzleSetStyle.display = "none"
            }
        }
    }

    //Change the background color depending on generated puzzle
    if (shownPuzzle == "puzzle1"){
        document.body.style.backgroundColor = "#edf8fb"
    }
    else if (shownPuzzle == "puzzle2"){
        document.body.style.backgroundColor = "#088F8F"
    }
    else {
        document.body.style.backgroundColor = "#eeedf3"
    }

    shufflePieces(shownPuzzle)
}

function shufflePieces(puzzleSet) {
    pieces = ["Piece1", "Piece2", "Piece3", "Piece4", "Piece5", "Piece6", "Piece7", "Piece8",
    "Piece9", "Piece10", "Piece11", "Piece12"]
    for (i = pieces.length - 1; i > 0; i--) {
        randomIndex = Math.trunc(Math.random() * (i + 1));
        [pieces[i], pieces[randomIndex]] = [pieces[randomIndex], pieces[i]];
    }

    imageContainer = document.getElementById(puzzleSet + "Container")

    for (i = 0; i < pieces.length; i++){
        image = document.getElementById(puzzleSet + pieces[i])
        imageContainer.appendChild(image)
    }
}

function grabber(event) {
    event.preventDefault()
    grabbedPiece = event.target
    
    // Calculate the offset between the mouse pointer and the top-left corner of the puzzle piece
    offsetX = event.clientX - grabbedPiece.getBoundingClientRect().left
    offsetY = event.clientY - grabbedPiece.getBoundingClientRect().top
    
    // Set the puzzle piece's position to 'absolute' to enable free dragging
    grabbedPiece.style.position = 'absolute'
    
    document.addEventListener('mousemove', move)
    document.addEventListener('mouseup', release)
}

function move(event) {
    // Update the position of the puzzle piece based on the mouse pointer position
    grabbedPiece.style.left = (event.clientX - offsetX) + 'px'
    grabbedPiece.style.top = (event.clientY - offsetY) + 'px'
}

function release(event) {
    document.removeEventListener('mousemove', move)
    document.removeEventListener('mouseup', release)
    
    // Reset the grabbedPiece variable to null to indicate that no puzzle piece is currently grabbed
    grabbedPiece = null
}

function isCorrect() {
    grid = document.getElementById("grid").getBoundingClientRect()
    column1 = grid.left
    column2 = (grid.left + (grid.width * .25))
    column3 = (column2 + (grid.width * .25))
    column4 = (column3 + (grid.width * .25))
    row1 = grid.top
    row2 = (grid.top + (grid.height * (1/3)))
    row3 = (row2 + (grid.height * (1/3)))
    numCorrect = 0

    console.log(column1, column2, column3, column4)
    console.log(row1, row2, row3)
    
    for (i = 1; i < 13; i++) {
        image = document.getElementById(shownPuzzle + "Piece" + (i))
        console.log(image)
        imageLeft = image.getBoundingClientRect().left
        imageTop = image.getBoundingClientRect().top

        console.log("Image" + i + ": " + imageLeft, imageTop)

        if (i == 1) {
            if (Math.abs(imageTop - row1) <= 10 && Math.abs(imageLeft - column1) <= 10) {
                numCorrect++
            }
        }
        else if (i == 2) {
            if (Math.abs(imageTop - row1) <= 10 && Math.abs(imageLeft - column2) <= 10) {
                numCorrect++
            }
        }
        else if (i == 3) {
            if (Math.abs(imageTop - row1) <= 10 && Math.abs(imageLeft - column3) <= 10) {
                numCorrect++
            }
        }
        else if (i == 4) {
            if (Math.abs(imageTop - row1) <= 10 && Math.abs(imageLeft - column4) <= 10) {
                numCorrect++
            }
        }
        else if (i == 5) {
            if (Math.abs(imageTop - row2) <= 10 && Math.abs(imageLeft - column1) <= 10) {
                numCorrect++
            }
        }
        else if (i == 6) {
            if (Math.abs(imageTop - row2) <= 10 && Math.abs(imageLeft - column2) <= 10) {
                numCorrect++
            }
        }
        else if (i == 7) {
            if (Math.abs(imageTop - row2) <= 10 && Math.abs(imageLeft - column3) <= 10) {
                numCorrect++
            }
        }
        else if (i == 8) {
            if (Math.abs(imageTop - row2) <= 10 && Math.abs(imageLeft - column4) <= 10) {
                numCorrect++
            }
        }
        else if (i == 9) {
            if (Math.abs(imageTop - row3) <= 10 && Math.abs(imageLeft - column1) <= 10) {
                numCorrect++
            }
        }
        else if (i == 10) {
            if (Math.abs(imageTop - row3) <= 10 && Math.abs(imageLeft - column2) <= 10) {
                numCorrect++
            }
        }
        else if (i == 11) {
            if (Math.abs(imageTop - row3) <= 10 && Math.abs(imageLeft - column3) <= 10) {
                numCorrect++
            }
        }
        else if (i == 12) {
            if (Math.abs(imageTop - row3) <= 10 && Math.abs(imageLeft - column4) <= 10) {
                numCorrect++
            }
        }
    }

    if (numCorrect == 12) {
        alert("Congratulations! You got it!")
    }
    else {
        alert("Better luck next time.")
    }
}