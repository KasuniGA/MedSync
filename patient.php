<?php
session_start();
$title = "Profile";
$web_title = "Profile";
include_once "site_parts/dash_header.php";
$json_path = "config/credentials.json";
include("db.php");
?>

<?php 
if (!(isset($_SESSION["doctor"]) && $_SESSION['role'] == "doctor")) {
    header("Location: ./index.php");
    exit();
}
?>











<?php
// include_once "site-parts/footer_part.php";
include_once "site_parts/dash_footer.php";
?>