<?php

use Kreait\Firebase\Factory;

function register_user($data) {
    $json_path = "../config/credentials.json";
    require "../db.php";
    
    if (count($data) == 23) {
        $full_name = $data[0];
        $first_name = $data[1];
        $last_name = $data[2];
        $gender = $data[3];
        $dob = $data[4];
        $nic = $data[5];
        $blood = $data[6];
        $address_l1 = $data[7];
        $address_l2 = $data[8];
        $district = $data[9];
        $phone= $data[10];
        $email = $data[11];
        $emg_name = $data[12];
        $rel_name = $data[13];
        $emg_phone = $data[14];
        $emg_address_l1 = $data[15];
        $emg_address_l2 = $data[16];
        $emg_district = $data[17];
        $med_allergy = $data[18];
        $med_surgery = $data[19];
        $med_chronic = $data[20];
        $password = $data[21];
        $password_rep = $data[22];
        $uid = get_UID();
        
        
        
        // Create an associative array with the data
        $user_data = array(
            'full_name' => $full_name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'dob' => $dob,
            'nic' => $nic,
            'blood' => $blood,
            'address_l1' => $address_l1,
            'address_l2' => $address_l2,
            'district' => $district,
            'phone' => $phone,
            'email' => $email,
            'emg_name' => $emg_name,
            'rel_name' => $rel_name,
            'emg_phone' => $emg_phone,
            'emg_address_l1' => $emg_address_l1,
            'emg_address_l2' => $emg_address_l2,
            'emg_district' => $emg_district,
            'med_allergy' => $med_allergy,
            'med_surgery' => $med_surgery,
            'med_chronic' => $med_chronic,
            'uid' => $uid,
            'password' => $password
        );
       
        
    $ref = $database->getReference('app/MedSync/users/' . $uid)->set($user_data);
    $ref2 = $database->getReference('app/MedSync/nic/' . $nic)->set($uid);

    return $uid;
     
}
else {
    return false;
}
}
function register_doctor($data) {
    
    $json_path = "../config/credentials.json";
    require "../db.php";
    // $data = [$full_name, $first_name, $last_name, $gender, $dob, $nic, $address_l1, $address_l2, $district,$phone, $email, $mbbs, $password, $password_rep];

    if (count($data) == 14) {
        $full_name = $data[0];
        $first_name = $data[1];
        $last_name = $data[2];
        $gender = $data[3];
        $dob = $data[4];
        $nic = $data[5];
        $address_l1 = $data[6];
        $address_l2 = $data[7];
        $district = $data[8];
        $phone= $data[9];
        $email = $data[10];
        $mbbs = $data[11];
        $password = $data[12];
        $password_rep = $data[13];
        $uid = get_doc_UID();

        
        // Create an associative array with the data
        $user_data = array(
            'full_name' => $full_name,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'gender' => $gender,
            'dob' => $dob,
            'nic' => $nic,
            'mbbs' => $mbbs,
            'address_l1' => $address_l1,
            'address_l2' => $address_l2,
            'district' => $district,
            'phone' => $phone,
            'email' => $email,
            'uid' => $uid,
            'password' => $password
        );
       
        
    $ref = $database->getReference('app/MedSync/doctors/' . $uid)->set($user_data);
    return $uid;
}
else {
    return false;
}
}

function generateUID() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $uid = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 10; $i++) {
        $uid .= $characters[mt_rand(0, $max)];
    }
    return $uid;
}
function get_doc_UID() {
    $json_path = "../config/credentials.json";
    require "../db.php";

    $uid = "DR" . generateUID();
    $data = $database->getReference('app/MedSync/doctors/' . $uid . '/user_id' )->getValue();
    if ($data) {
        get_doc_UID();
    }
    else {
        return $uid;
    }
}
function get_UID() {
    $json_path = "../config/credentials.json";
    require "../db.php";

    $uid = generateUID();
    $data = $database->getReference('app/MedSync/users/' . $uid . '/user_id' )->getValue();
    if ($data) {
        get_UID();
    }
    else {
        return $uid;
    }
}

function check_doc_login($username, $password) {
    $json_path = "../config/credentials.json";
    require "../db.php";
    
    $data = $database->getReference('app/MedSync/doctors/' . $username)->getValue();
    if ($data) {
        if (($data["uid"] == $username) && ($data["password"] == $password)) {
            unset($array['password']);
            session_start();
            $_SESSION["role"] = "doctor";
            $_SESSION["doctor"] = $data;
            header("Location: ../dashboard.php");
            exit();
        } 
        else {
            header("Location: ../login.php?err=Incorrect Username or Password");
            exit();
        }
    }
}

function check_login($username, $password) {
    $json_path = "../config/credentials.json";
    require "../db.php";

    $data = $database->getReference('app/MedSync/users/' . $username)->getValue();
    $data_nic = $database->getReference('app/MedSync/nic/' . $username)->getValue();
    
    if ($data) {
        if (($data["uid"] == $username) && ($data["password"] == $password)) {
            unset($array['password']);
            session_start();
            $_SESSION["role"] = "user";
            $_SESSION["user"] = $data;
            header("Location: ../dashboard.php");
            exit();
        } 
        else {
            header("Location: ../login.php?err=Incorrect Username or Password");
            exit();
        }
        
    }
    else if ($data_nic) {
        $data = $database->getReference('app/MedSync/users/' . $data_nic)->getValue();
        if (($data["uid"] == $data_nic) && ($data["password"] == $password)) {
            print_r($data);
            unset($array['password']);
            session_start();
            $_SESSION["role"] = "user";
            $_SESSION["user"] = $data;
            header("Location: ../dashboard.php");
            exit();
        }
        else {
            header("Location: ../login.php?err=Incorrect Username or Password");
            exit();
        }

    }
    else {
        header("Location: ../login.php?err=Incorrect Username or Password");
        exit();
    }
}

function search_user($patient_id) {
    $json_path = "../config/credentials.json";
    require "../db.php";

    $val = $database->getReference('app/MedSync/users/' . $patient_id)->getValue();
    if ($val) {
        $_SESSION["patient"] = $val;
        return $val;
    } else {
        return false;
    }
}

function generateRandomKey() {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $key = '';
    $length = strlen($characters);

    for ($i = 0; $i < 16; $i++) {
        $key .= $characters[rand(0, $length - 1)];
    }

    return $key;
}

function add_main_section($key, $patient_id, $topic, $description, $doctor) {
    $json_path = "../config/credentials.json";
    require "../db.php";
    
    $main_report = array(
        'record_id' => $key,
        'topic' => $topic,
        'description' => $description,
        'ts' => time(),
        'doctor' => $doctor,
        'patient' => $patient_id,
        'content' => array(),
        'status' => 'Active'
    );
    
    
    $ref = $database->getReference('app/MedSync/reports/' . $patient_id . '/' . $key)->set($main_report);
}

function get_reports($user) {
    $json_path = "./config/credentials.json";
    require "./db.php";
    
    $report_data = $database->getReference('app/MedSync/reports/' . $user)->getValue();
    if ($report_data) {
        return $report_data;
    } else {
        return false;
    }
}
function get_all_docs() {
    $json_path = "./config/credentials.json";
    require "./db.php";
    
    $docs = $database->getReference('app/MedSync/doctors')->getValue();

    if ($docs) {
        return $docs;
    } else {
        return false;
    }
}

function  add_sub_section($patient, $main_key, $sub_key, $sub_topic, $sub_description, $type, $doctor, $image_list) {
    $json_path = "../config/credentials.json";
    require "../db.php";
    
    $sub_report = array(
        'sub_record_id' => $sub_key,
        'topic' => $sub_topic,
        'description' => $sub_description,
        'ts' => time(),
        'doctor' => $doctor,
        'patient' => $patient,
        'imsges' => $image_list,
        'type' => $type
    );
    
    
    $ref = $database->getReference("app/MedSync/reports/$patient/$main_key/content/$sub_key")->set($sub_report);
}

function change_section_status($patient, $main_key, $status) {
    $json_path = "../config/credentials.json";
    require "../db.php";
    
    $ref = $database->getReference("app/MedSync/reports/$patient/$main_key/status")->set($status);
}