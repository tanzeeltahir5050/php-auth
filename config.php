<?php

session_start();

$conn = mysqli_connect("localhost", "root", "", "auth");

$private = ["admin.php", "user.php"];
$fileName = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);

if (in_array($fileName, $private)) {
    if (!isset($_SESSION["username"])) {
        header("Location: login.php");
    }
}
