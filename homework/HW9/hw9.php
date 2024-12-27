<!DOCTYPE html>

<html lang = "en">

<head>
  <title>CS 329E Quiz</title>
  <meta charset = "UTF-8">
  <meta name = "description" content = "Self-Grading Quiz">
  <meta name = "author" content = "Primo Marquez">
  <link rel = "stylesheet" href = "hw9.css">
</head>

<body>

<form method = "POST">
    <h2 style = "text-align: center;"> Quiz 1 </h2>
    <h2 style = "text-align: center;"> CS 329E - Elements of Web Programming </h2>
    <h3 style = "text-align: center;"> March 26, 2024 </h3>

    <h3> True/False </h3>
        <p> 1. "URL" stands for "Universal Reference Link". </p>
            <p> <label> True <input name = "url" type = "radio" value = "true" > </label> </p>
            <p> <label> False <input name = "url" type = "radio" value = "false" > </label> </p>
        <p> 2. An Apple MacBook is an example of a linux system. </p>
            <p> <label> True <input name = "apple" type = "radio" value = "true" > </label> </p>
            <p> <label> False <input name = "apple" type = "radio" value = "false" > </label> </p>

    <h3> Multiple Choice </h3>
        <p> 3. Which of these do NOT contribute to packet delay in a packet switching network? </p>
            <p> <label> Processing delay at a router <input name = "packet[]" type = "checkbox" value = "router" > </label> </p>
            <p> <label> CPU workload on a client <input name = "packet[]" type = "checkbox" value = "CPU" > </label> </p>
            <p> <label> Transmission delay along a communciations link <input name = "packet[]" type = "checkbox" value = "transmission" > </label> </p>
            <p> <label> Propagation delay <input name = "packet[]" type = "checkbox" value = "propagation"> </label>
        <p> 4. This Internet layer is responsible for creating the packets that move across the network. </p>
            <p> <label> Physical <input name = "layer[]" type = "checkbox" value = "physical" > </label> </p>
            <p> <label> Data link <input name = "layer[]" type = "checkbox" value = "data" > </label> </p>
            <p> <label> Network <input name = "layer[]" type = "checkbox" value = "network" > </label> </p>
            <p> <label> Transport <input name = "layer[]" type = "checkbox" value = "transport" > </label> </p>

    <h3> Fill in the Blank </h3>
        <p> 5. <textarea name = "protocol" rows = "1"></textarea> is a networking protocol that runs over TCP/IP and governs communication between web browsers and web servers.</p>
        <p> 6. A small icon displayed in a browser table that identifies a website is called a <textarea name = "icon" rows = "1"></textarea>. </p>

    <br>

    <p>
        <input type = "submit" value = "Grade">
        <input type = "reset" value = "Clear">
    </p>
</form>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $gradeTotal = 0;

        if (!isset($_POST["url"])) {
            echo "<script>alert('Please answer question 1')</script>";
        }

        elseif (!isset($_POST["apple"])) {
            echo "<script>alert('Please answer question 2')</script>";
        }

        elseif (!isset($_POST["packet"])) {
            echo "<script>alert('Please answer question 3')</script>";
        }

        elseif (!isset($_POST["layer"])) {
            echo "<script>alert('Please answer question 4')</script>";
        }

        elseif (empty($_POST["protocol"])) {
            echo "<script>alert('Please answer question 5')</script>";
        }

        elseif (empty($_POST["icon"])) {
            echo "<script>alert('Please answer question 6')</script>";
        }

        else {
            $question1 = $_POST["url"];
            if ($question1 == "false") {
                $gradeTotal++;
            }

            $question2 = $_POST["apple"];
            if ($question2 == "true") {
                $gradeTotal++;
            }

            $question3 = $_POST["packet"];
            if (count($question3) == 1 && in_array("CPU", $question3)) {
                $gradeTotal++;
            }

            $question4 = $_POST["layer"];
            if (count($question4) == 1 && in_array("network", $question4)) {
                $gradeTotal++;
            }

            $question5 = $_POST["protocol"];
            if (strtolower($question5) == "http") {
                $gradeTotal++;
            }

            $question6 = $_POST["icon"];
            if (strtolower($question6) == "favicon") {
                $gradeTotal++;
            }

            echo "<script>alert('Your score is " . $gradeTotal . "/6.')</script>";
        }
    }
?>

</body>
</html>