<?php
session_start();
$title = "Patient History";
$web_title = "Patient History";
include_once "site_parts/dash_header.php";
$json_path = "config/credentials.json";
include("db.php");
?>