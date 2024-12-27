<?php 
include "logIn.php";
session_start();
$script = $_SERVER["PHP_SELF"];

if (!isset($_SESSION['loggedIn'])) {
    header("Location: logIn.php");
}
?>

<!DOCTYPE html>

<html lang = "en">

<head>
  <title>User Registration</title>
  <meta charset = "UTF-8">
  <meta name = "description" content = "Use AJAX to determine if a user exists in a database">
  <meta name = "author" content = "Primo Marquez">
  <link rel = "stylesheet" href = "X3.css">
</head>

<body>

<script language = "javascript">
    function ajaxFunction() {
        name = document.getElementById("name").value
        item = document.getElementById("item").value

        if (name == '' || item == '') {
            alert("Please enter name and item.")
            return
        }

        ajaxRequest = new XMLHttpRequest()
        ajaxRequest.onreadystatechange = function() {
            if (ajaxRequest.readyState == 4) {
                ajaxDisplay = document.getElementById("ajaxDiv")
		ajaxDisplay.innerHTML = ajaxRequest.responseText
                document.getElementById("name").value = ""
                document.getElementById("item").value = ""
            }
        }

        name = encodeURIComponent(document.getElementById("name").value)
        item = document.getElementById("item").value

        queryString = "?name=" + name + "&item=" + item
        
        ajaxRequest.open("GET", "ajax.php" + queryString, true)
        ajaxRequest.send(null)
    }
</script>

<div class = "container">
    <h3>Potluck Information</h3>
    <table>
    <form method = "POST" name = "myForm" action = "ajax.php">
        <tr>
            <td>Name:</td>
            <td><input id = "name" name = "name" type = "text" required maxlength = "20"></td>
        </tr>
        <tr>
            <td>Item:</td>
            <td><input id = "item" name = "item" type = "text" required maxlength = "50"></td>
        </tr>
        <tr>
            <td colspan = "2"><input type = "button" value = "Submit" onclick = "ajaxFunction()"></td>
        </tr>
    </form>
    </table>

    <div id = "ajaxDiv"></div>
</div>

</body>
</html>