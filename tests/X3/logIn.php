<?php
session_start();
$script = $_SERVER["PHP_SELF"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (authenticate($username, $password)) {
        $_SESSION['loggedIn'] = true;
        header("Location: potluck.php");
    }
    else {
	    echo "<script>alert('Login Failed.')</script>";
    }
}

function authenticate($user, $password) {
    $username = "potluck";
    $pwd = "feedMeN0w";
    return $user == $username && $pwd == $password;
}

if (!isset($_SESSION['loggedIn'])) {
print <<<FORM
<!DOCTYPE html>

<html lang = "en">

<head>
    <title>Exam 3</title>
    <meta charset = "UTF-8">
    <meta name = "description" content = "Potluck organization">
    <meta name = "author" content = "Primo Marquez">
    <link rel = "stylesheet" href = "style.css">
</head>

<body>
<div class = "container">
<table>
    <form method = "POST" action = $script>
        <tr> <td> Username: </td> <td> <input type = "text" name = "username" autofocus required> </td> </tr>
        <tr> <td> Password: </td> <td> <input type = "password" name = "password" required> </td> </tr>
        <tr> 
          <td> <input type = "submit" value = "Login"> </td>
          <td> <input type = "reset" name = "reset" value = "Reset"> </td> 
        </tr>
    </form>
</table>
</div>
</body>
</html>
FORM;
}
?>

