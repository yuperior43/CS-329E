<!DOCTYPE html>

<html lang = "en">

<head>
  <title>Login demo</title>
  <meta charset = "UTF-8">
  <meta name = "description" content = "Login demo">
  <meta name = "author" content = "Primo Marquez">
</head>

<?php
  // If the request method is POST, verify the submitted username and password
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    // Get values submitted from the login form
    $username = $_POST["username"];
    $password = $_POST["password"];

    //"beyonce" is the only authorized user: her name and password are hard-coded into the 
    //file just 'cuz she's Beyonce
    if ($username == "beyonce" && $password == "lemonade") {

      //create a session variable "username" that contains the value username. We can test
      //to see if this variable has a value later on to confirm that the user previously
      //logged in successfully.
      $_SESSION["username"] = $username;

      //use the function header() to redirect us to the desired page. header() adds a
      //header
      //to the HTTP response, and calling header() with a "Location: url" argument
      //initiates
      //the redirect.
      header("Location: login_success.html");
      die;
    }

    else {
      echo "<p> Incorrect name or password. </p>";
    }
  }
?>

<!-- If the request was a GET, then present the login screen instead -->
<body>
<form method = "POST" action = "login.php">
  <div> Username: <input type = "text" name = "username" autofocus> </div>
  <div> Password: <input type = "password" name = "password"> </div>
  <input type = "submit" value = "Login">
</form>
</body>

</html>