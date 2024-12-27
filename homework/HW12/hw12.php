<?php
session_start();
$script = $_SERVER['PHP_SELF'];
$page = $_GET['page'];

if (!isset($_COOKIE['loggedIn']) && in_array($page, ['story1', 'story2', 'story3', 'story4', 'story5'])) {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
    header("Location: $script?page=logIn");
}

switch ($page) {
    case "story1":
        storyOne();
        break;
    case "story2":
        storyTwo();
        break;
    case "story3":
        storyThree();
        break;
    case "story4":
        storyFour();
        break;
    case "story5":
        storyFive();
        break;
    case "logIn":
        logIn();
        break;
    case "signUp":
        signUp();
        break;
    default:
        homePage();
        break;
}

function homePage() {

$script = $_SERVER['PHP_SELF'];

print <<<HOME
<!DOCTYPE html>
<head>
  <title>HW12</title>
  <link rel = "stylesheet" href = "hw12.css">
</head>

<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<a href="$script?page=logIn"><img id = "loginButton" src = "profile-icon.jpg" alt = "Login Icon"></a>
<p id = 'loginText'>Sign in</p>
<h3>Daily Headlines</h3>
<a href = "$script?page=story1"><img class = "storyImage" src = "mavericks.jpg" alt = "Dallas Mavericks"></a>
<h4><a href="$script?page=story1">Dallas Mavericks clinch playoff spot, set to face Clippers in first round</a></h4>
<a href = "$script?page=story2"><img class = "storyImage" src = "eclipse.jpg" alt = "Total Eclipse"></a>
<h4><a href="$script?page=story2">Clouds cover total solar eclipse, much to the dismay of Austinites</a></h4>
<a href = "$script?page=story3"><img class = "storyImage" src = "roommate.jpg" alt = "Local Roommate"></a>
<h4><a href="$script?page=story3">Roomate gets a job?!</a></h4>
<a href = "$script?page=story4"><img class = "storyImage" src = "traffic.jpg" alt = "Traffic"></a>
<h4><a href="$script?page=story4">Austin traffic - here's what to expect today</a></h4>
<a href = "$script?page=story5"><img class = "storyImage" src = "day.jpg" alt = "Summer Day"></a>
<h4><a href="$script?page=story5">Aren't you exicted for the end of the semester? Here's what to do during your break!</a></h4>
</div>
</body>
</html>

HOME;

}

function logIn() {

$script = $_SERVER['PHP_SELF'];

if (isset($_SESSION['redirect_url'])) {
    $redirect_url = $_SESSION['redirect_url'];
} else {
    $redirect_url = $script;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    if (authenticate($user_id, $password)) {
        setcookie('loggedIn', true, time()+120, '/');
        header("Location: $redirect_url");
        unset($_SESSION['redirect_url']);
    } else {
        echo "<script>alert('Invalid username or password. Please try again.')</script>";
    }
}

print <<<LOGIN
<!DOCTYPE html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" href="hw12.css">
</head>
<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<h3>Sign in</h3>
<form action="$script?page=logIn" method="post">
    <table border="1">
        <tr>
            <td>User ID</td>
            <td><input name="user_id" type="text" size="30" required></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input name="password" type="password" size="30" required></td>
        </tr>
    </table>
    <input type="submit" name = "logIn" value="Log in">
</form>
<p>Don't have an account? Click <a href="$script?page=signUp">here</a> to sign up.</p>
<p><a href="$script"> Back to home </a></p>
</div>
</body>
</html>
LOGIN;

}

function signUp() {

$script = $_SERVER['PHP_SELF'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    if (userExists($user_id)) {
        echo "<script>alert('Username taken. Please choose a different username.')</script>";
    } else {
        $file = fopen("passwd.txt", "a");
        fwrite($file, "$user_id:$password\n");
        fclose($file);
        echo "Account created successfully. You can now log in.";
        header("Location: $script?page=logIn");
    }
}

print <<<SIGN
<!DOCTYPE html>
<head>
    <title>Signup</title>
    <link rel="stylesheet" href="hw12.css">
</head>
<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<h3>Create an account</h3>
<form action="$script?page=signUp" method="post">
    <table border="1">
        <tr>
            <td>Create user ID</td>
            <td><input name="user_id" type="text" size="30" required></td>
        </tr>
        <tr>
            <td>Create password</td>
            <td><input name="password" type="password" size="30" required></td>
        </tr>
    </table>
    <input type="submit" name = "logUserInfo" value = "Create account">
</form>
<p>Already have an account? Log in <a href="$script?page=logIn">here</a>.</p>
<p><a href="$script"> Back to home </a></p>
</div>
</body>
</html>
SIGN;

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

function userExists($user_id) {
    $file = fopen("passwd.txt", "r");
    while (($line = fgets($file)) != false) {
        $dataLine = explode(':', $line, 2);
        $currentID = trim($dataLine[0]);
        
        if ($currentID === $user_id) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

function storyFive() {

$script = $_SERVER['PHP_SELF'];

print <<<FIVE
<!DOCTYPE html>
<head>
  <title>HW12</title>
  <link rel="stylesheet" href="hw12.css">
</head>

<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<h3>Aren't you exicted for the end of the semester? Here's what to do during your break!</h3>
<p class='story'> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
<p><a href="$script"> Back to home </a></p>
</div>
</body>
</html>

FIVE;
}

function storyFour() {

$script = $_SERVER['PHP_SELF'];

print <<<FOUR
<!DOCTYPE html>
<head>
  <title>HW12</title>
  <link rel="stylesheet" href="hw12.css">
</head>

<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<h3>Austin traffic - here's what to expect today</h3>
<p class='story'> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
<p><a href="$script"> Back to home </a></p>
</div>
</body>
</html>

FOUR;
}

function storyThree() {

$script = $_SERVER['PHP_SELF'];

print <<<THREE
<!DOCTYPE html>
<head>
  <title>HW12</title>
  <link rel="stylesheet" href="hw12.css">
</head>

<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<h3>Roomate gets a job?!</h3>
<p class='story'> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
<p><a href="$script"> Back to home </a></p>
</div>
</body>
</html>

THREE;
}

function storyTwo() {

$script = $_SERVER['PHP_SELF'];

print <<<TWO
<!DOCTYPE html>
<head>
  <title>HW12</title>
  <link rel="stylesheet" href="hw12.css">
</head>

<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<h3>Clouds cover total solar eclipse, much to the dismay of Austinites</h3>
<p class='story'> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
<p><a href="$script"> Back to home </a></p>
</div>
</body>
</html>

TWO;
}

function storyOne() {

$script = $_SERVER['PHP_SELF'];

print <<<ONE
<!DOCTYPE html>
<head>
  <title>HW12</title>
  <link rel="stylesheet" href="hw12.css">
</head>

<body>
<div class = 'container'>
<h2>The Daily Morning News, Austin</h2>
<h3>Dallas Mavericks clinch playoff spot, set to face Clippers in first round</h3>
<p class='story'> Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. 
Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. </p>
<p><a href="$script"> Back to home </a></p>
</div>
</body>
</html>

ONE;
}
?>
