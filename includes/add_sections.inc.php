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
else if (isset($_POST["new_sub_record"]) && $_SESSION["role"] == "doctor") {
    
    $sub_topic = trim($_POST["sub_topic"]);
    $sub_description = trim($_POST["sub_description"]);
    $sub_key = trim($_POST["sub_key"]);
    $main_key = trim($_POST["main_key"]);
    $type = trim($_POST["type"]);
    $doctor = $_SESSION["doctor"]["uid"];
    $patient = $_SESSION["patient"]["uid"];

    $image_list = [];

    if(isset($_FILES['images']) && count($image_list) > 0) {

    $uploadedFiles = $_FILES['images'];
    $uploadFolder = "../img/";
    $maxFileSize = 5 * 1024 * 1024; // 5MB

    foreach($uploadedFiles['tmp_name'] as $key => $tmpName){
        $fileName = $uploadedFiles['name'][$key];
        $fileSize = $uploadedFiles['size'][$key];
        $fileType = $uploadedFiles['type'][$key];
        $fileTmpName = $uploadedFiles['tmp_name'][$key];

        // Check file size
        if($fileSize > $maxFileSize){
            header("Location: ../history.php?err=Maximum file size is 5MB");
            exit();
        }
        
        // Check file type
        $validTypes = ['image/jpeg', 'image/png'];
        if(!in_array($fileType, $validTypes)){
            header("Location: ../history.php?err=Only valid jpg, png, jpeg file types");
            exit();
        }
        $uniqueFileName = uniqid() . '_' . $fileName;
        $image_list[] = $uniqueFileName;
        $targetFilePath = $uploadFolder . $uniqueFileName;

        move_uploaded_file($fileTmpName, $targetFilePath);
    
    }
}
    $data = [$sub_topic, $sub_description, $type];
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i] == "") {
            header("Location: ../history.php?err=Fill all required details");
            exit();
        }
    }

    add_sub_section($patient, $main_key, $sub_key, $sub_topic, $sub_description, $type, $doctor, $image_list);
    header("Location: ../history.php?ok=New sub section added");
    exit();
}

else if (isset($_POST["main_section_status"]) && $_SESSION["role"] == "doctor") {
    $main_key = $_POST["main_key"];
    $patient = $_POST["patient"];
    $status = $_POST["status"];
    
    $data = [$main_key, $patient, $status];
    for ($i = 0; $i < count($data); $i++) {
        if ($data[$i] == "") {
            header("Location: ../history.php?err=Reload your web page");
            exit();
        }
    }
    change_section_status($patient, $main_key, $status);
    header("Location: ../history.php?ok=Report status changed");
    exit();
    
}

else {
    header("Location: ../dashboard.php");
}