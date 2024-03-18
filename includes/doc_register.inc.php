<?php
$json_path = "../config/credentials.json";
require "../db.php";
require "functions.inc.php";

if (isset($_POST["doc_submission"]))
{
    $full_name = $_POST["full-name"];
    $first_name = $_POST["f-name"];
    $last_name = $_POST["l-name"];
    $gender = $_POST["gender"];
    $dob = $_POST["dob"];
    $nic = $_POST["nic"];
    $address_l1 = $_POST["address-1"];
    $address_l2 = $_POST["address-2"];
    $district = $_POST["district"];
    $phone= $_POST["p-num"];
    $email = $_POST["e-mail"];
    $mbbs = $_POST["mbbs"];
    $password = $_POST["password"];
    $password_rep = $_POST["password_rep"];

    $data = [$full_name, $first_name, $last_name, $gender, $dob, $nic, $address_l1, $address_l2, $district,$phone, $email, $mbbs, $password, $password_rep];
    $req_data = [$full_name, $first_name, $last_name, $gender, $dob, $nic, $address_l1, $address_l2, $district,$phone, $email, $mbbs, $password, $password_rep];

    for ($i = 0; $i < count($req_data); $i++) {
        if ($req_data[$i] == "") {
            header("Location: ../doctor_register.php?err=Fill all required details");
            exit();
        }
    }
    if ($password != $password_rep) {
        header("Location: ../doctor_register.php?err=Password did not matched!");
        exit();
    }

    $key = register_doctor($data);
    if ($key) {
        header("Location: ../doctor_register.php?ok=Doctor Registered Successfully. Your ID is: $key");
    }
    else {
        header("Location: ../doctor_register.php?err=Something went wrong");
    }
}
?>