<?php 
include "quizProcessing.php";
$script = $_SERVER["PHP_SELF"];
?>

<!--Initialize HTML for php to use based on question-->
<html>
<head>
<title> CS 329E Quiz </title>
<link rel = "stylesheet" href = "hw13.css">
</head>
<body>
<h2 style = "text-align: center;"> Quiz 1 </h2>
<h2 style = "text-align: center;"> CS 329E - Elements of Web Programming </h2>
<h3 style = "text-align: center;"> April 16, 2024 </h3>

<?php
//Login screen
if ($number == 0) {
    print <<<LOGIN
    <h4 style = "text-align: center;"> You must log in to take this quiz. Once you are logged in, you will have 15 minutes to take the quiz. Please note that if you do not finish within the time limit, 
    your last question submission will <i>not</i> count!</h4>
    <div class = "container"> <table>
        <form id = "quizForm" method = "post" action = $script>
            <tr> <td> Username: </td> <td> <input type = "text" name = "username" autofocus> </tr>
            <tr> <td> Password: </td> <td> <input type = "password" name = "password"> </tr>
	    <tr> <td colspan = "2"> <input type = "submit" value = "Log in"> </td> </tr>
        </form>
    </table> </div>
LOGIN;
}

//Quiz questions
if ($number == 1) {
    print <<<QUESTION1
    <form method = "post" action = $script>
        <h3> True/False </h3>
        <p> 1. "URL" stands for "Universal Reference Link". </p>
        <p> <label> True <input name = "url" type = "radio" value = "true" > </label> </p>
        <p> <label> False <input name = "url" type = "radio" value = "false" > </label> </p>
        <input type = "submit" value = "Submit">
    </form>
QUESTION1;
} 
else if ($number == 2) {
    print <<<QUESTION2
    <form method = "post" action = $script>
        <h3> True/False </h3>
        <p> 2. An Apple MacBook is an example of a linux system. </p>
        <p> <label> True <input name = "apple" type = "radio" value = "true" > </label> </p>
        <p> <label> False <input name = "apple" type = "radio" value = "false" > </label> </p>
        <input type = "submit" value = "Submit">
    </form>
QUESTION2;
}
else if ($number == 3) {
    print <<<QUESTION3
    <form method = "post" action = $script>
        <h3> Multiple Choice </h3>
        <p> 3. Which of these do NOT contribute to packet delay in a packet switching network? </p>
        <p> <label> Processing delay at a router <input name = "packet[]" type = "checkbox" value = "router" > </label> </p>
        <p> <label> CPU workload on a client <input name = "packet[]" type = "checkbox" value = "CPU" > </label> </p>
        <p> <label> Transmission delay along a communciations link <input name = "packet[]" type = "checkbox" value = "transmission" > </label> </p>
        <p> <label> Propagation delay <input name = "packet[]" type = "checkbox" value = "propagation"> </label> </p>
        <input type = "submit" value = "Submit">
    </form>
QUESTION3;
}
else if ($number == 4) {
    print <<<QUESTION4
    <form method = "post" action = $script>
        <h3> Multiple Choice </h3>
        <p> 4. This Internet layer is responsible for creating the packets that move across the network. </p>
        <p> <label> Physical <input name = "layer[]" type = "checkbox" value = "physical" > </label> </p>
        <p> <label> Data link <input name = "layer[]" type = "checkbox" value = "data" > </label> </p>
        <p> <label> Network <input name = "layer[]" type = "checkbox" value = "network" > </label> </p>
        <p> <label> Transport <input name = "layer[]" type = "checkbox" value = "transport" > </label> </p>
        <input type = "submit" value = "Submit">
    </form>
QUESTION4;
}
else if ($number == 5) {
    print <<<QUESTION5
    <form method = "post" action = $script>
        <h3> Fill in the Blank </h3>
        <p> 5. <textarea name = "protocol" rows = "1" autofocus></textarea> is a networking protocol that runs over TCP/IP and governs communication between web browsers and web servers.</p>
        <input type = "submit" value = "Submit">
    </form>
QUESTION5;
}
else if ($number == 6) {
    print <<<QUESTION6
    <form method = "post" action = $script>
        <h3> Fill in the Blank </h3>
        <p> 6. A small icon displayed in a browser table that identifies a website is called a <textarea name = "icon" rows = "1" autofocus></textarea>. </p>
        <input type = "submit" value = "Submit">
    </form>
QUESTION6;
}

//Quiz results
else if ($number == 7) {
    echo '<form>';
    echo '<input id = "results" type = "hidden"> You got ' . ($_SESSION["grade"] * 10) . '/60. You may close this tab when you are ready.';
    echo '</form>';
    session_destroy();
}

?>

<!--Finish HTML document-->
</body>
</html>