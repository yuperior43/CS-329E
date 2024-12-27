<?php
session_start();
$script = $_SERVER["PHP_SELF"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: logout.php");
    }
    if (authenticate($username, $password)) {
        $_SESSION['loggedIn'] = true;
        header("Location: action.php");
    }
    else {
	echo "<script>alert('Login Failed.')</script>";
    }
}

function authenticate($user_id, $password) {
    $file = fopen("passwd.txt", "r");
    while (($line = fgets($file)) != false) {
        $dataLine = explode(':', $line, 2);
        $currentID = trim($dataLine[0]);
        $currentPass = trim($dataLine[1]);
        if ($currentID === $user_id && $currentPass === $password) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

if (!isset($_SESSION['loggedIn'])) {
print <<<FORM
<!DOCTYPE html>

<html lang = "en">

<head>
    <title>Web Interface</title>
    <meta charset = "UTF-8">
    <meta name = "description" content = "Interface to make SQL queries">
    <meta name = "author" content = "Primo Marquez">
    <link rel = "stylesheet" href = "hw14.css">
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

