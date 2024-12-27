<?php
session_start();

if (!isset($_SESSION["pageLoaded"])) {
    $_SESSION["pageLoaded"] = true;
    include "logIn.php";
    echo '<script>alert("Thank you!")</script>';
} else {
    include "logIn.php";
}
?>