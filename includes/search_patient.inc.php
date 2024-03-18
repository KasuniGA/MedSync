<?php
$json_path = "../config/credentials.json";
require "../db.php";
require "functions.inc.php";
session_start();

if (isset($_POST["search_patient"]) && $_SESSION["role"] == "doctor") {
    $patient_id = trim($_POST["patient_id"]);
    $key = search_user($patient_id);
    if ($key) {
        header("Location: ../dashboard.php?ok=User details found");
    }
    else {
        header("Location: ../dashboard.php?err=Sorry, This is not a valid user id");
    }
    
}
else {
    header("Location: ../dashboard.php");
}

if (isset($_POST["forget_patient"]) && $_SESSION["role"] == "doctor") {
    unset($_SESSION["patient"]);
    header("Location: ../dashboard.php?ok=Patient Session Ended");
    exit();
}