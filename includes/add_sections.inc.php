<?php
$json_path = "../config/credentials.json";
require "../db.php";
require "functions.inc.php";
session_start();

if (isset($_POST["new_main_record"]) && $_SESSION["role"] == "doctor") {
    $topic = trim($_POST["topic"]);
    $description = trim($_POST["description"]);
    $key = trim($_POST["key"]);
    
    add_main_section($key ,$_SESSION["patient"]["uid"], $topic, $description, $_SESSION["doctor"]["uid"]);
    header("Location: ../history.php?ok=New main section added");
    exit();
}
else {
    header("Location: ../dashboard.php");
}

if (isset($_POST["new_sub_record"]) && $_SESSION["role"] == "doctor") {
    // unset($_SESSION["patient"]);
    // header("Location: ../dashboard.php?ok=Patient Session Ended");
    // exit();
}