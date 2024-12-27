<?php
$script = $_SERVER["PHP_SELF"];
session_start();

//Initialize session variables
if (!isset($_SESSION["number"])) {
    $_SESSION["number"] = 0;
    $_SESSION["correct"] = 0;
}
$number = $_SESSION["number"];
$correct = $_SESSION["correct"];
$total_number = 6;

//POST processing
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION["quizAnswers"])) {
        $_SESSION["quizAnswers"] = array();
    }
    $_SESSION["quizAnswers"][$number] = $_POST;

    //Handle user authentication with pre-determined users in .txt file
    if ($number == 0 && isset($_POST["username"], $_POST["password"])) { 
        $username = $_POST["username"];
        $password = $_POST["password"];

        if (userExists($username)) {
            echo "<script>alert('You may not take this quiz more than once.')</script>";
        }
        else if (authenticate($username, $password)) {
            setcookie('loggedIn', true, time() + (15 * 60));
            $_SESSION["number"] = 1;
            $_SESSION["username"] = $username;
            header("Location: " . $script);
        } else {
            echo "<script>alert('Invalid username or password');</script>";
        }

    //Handle quiz grading and exceeded time limit. If the cookie expired, direct user to results without grading current question
    } else {
        if (!isset($_COOKIE["loggedIn"])	) {
            $_SESSION["number"] = 7;
            header("Location: " . $script);
        } else {
            $_SESSION["grade"] = gradeQuiz($_SESSION["username"]);
            $_SESSION["number"]++;
            header("Location: " . $script);
        }
    }
}

//Basic authentication function
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

//Basic function that checks if user has taken the quiz once
function userExists($user_id) {
    $file = fopen("results.txt", "r");
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

//Basic function that grades quiz and updates user with corresponding score as they submit a question
function gradeQuiz($username) {
    $correct = 0;
    $quizAnswers = $_SESSION["quizAnswers"];
    $question1 = $quizAnswers[1]["url"] ?? '';
    if ($question1 == "false") {
        $correct++;
    }
    $question2 = $quizAnswers[2]["apple"] ?? '';
    if ($question2 == "true") {
        $correct++;
    }
    $question3 = $quizAnswers[3]["packet"] ?? [];
    if (count($question3) == 1 && in_array("CPU", $question3)) {
        $correct++;
    }
    $question4 = $quizAnswers[4]["layer"] ?? [];
    if (count($question4) == 1 && in_array("network", $question4)) {
        $correct++;
    }
    $question5 = $quizAnswers[5]["protocol"] ?? '';
    if (strtolower($question5) == "http") {
        $correct++;
    }
    $question6 = $quizAnswers[6]["icon"] ?? '';
    if (strtolower($question6) == "favicon") {
        $correct++;
    }
    $scores = array();
    $file = fopen("results.txt", "r");
    while (($line = fgets($file)) !== false) {
        list($user, $score) = explode(':', $line, 2);
        $scores[$user] = (int)trim($score);
    }
    fclose($file);
    if (array_key_exists($username, $score)) {
        $scores[$username] = $correct;
    } else { 
        $scores[$username] = $correct;
    }
    $file = fopen("results.txt", "w");
    foreach ($scores as $user => $score) {
        fwrite($file, "$username:$correct\n");
    }
    fclose($file);
    return $correct;
}

?>