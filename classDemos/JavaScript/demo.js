/* myString = prompt("Enter a string:")
document.writeln(myString)
console.log("myString = " + myString)
alert("Did this work?") */

/* myString = prompt('Enter a string: ')
document.writeln(('     ') + parseInt(myString))
document.writeln(isNaN(myString)) */

myArray = [1, 2, 3, 4, 5]
document.writeln(myArray)

for (i = 0; i < 5; i ++) {
    document.writeln(myArray[i])
}

myArray2 = []
myArray2[0] = 0
myArray2[2] = 2
document.writeln(myArray2)

for (i = 0; i < 5; i ++) {
    document.writeln(myArray2[i])
}

document.writeln(Math.sqrt(myArray[2]))
