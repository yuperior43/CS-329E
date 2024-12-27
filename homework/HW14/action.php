<?php 
include "logIn.php";
$script = $_SERVER["PHP_SELF"];

if (!isset($_SESSION['loggedIn'])) {
    header("Location: logIn.php");
}

print <<<ACTION
<html>
<head>
<title> Web Interface </title>
<link rel = "stylesheet" href = "hw14.css">
</head>

<body>
<div class = "container">
<h2 style = "text-align: center;"> <u> Actions </u> </h2>
<ul>
    <li><a href = "insert.php">Insert Student Record</a></li>
    <li><a href = "update.php">Update Student Record</a></li>
    <li><a href = "delete.php">Delete Student Record</a></li>
    <li><a href = "view.php">View Student Record</a></li>
</ul>
<form method = "post" action = $script>
    <input type = "submit" name = "logout" value = "Logout">
</form>
</div>
</body>
</html>
ACTION;

?>
