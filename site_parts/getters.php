<?php
function required_star() {
return '<span style="color: red;">*</span>';
}

function get_districts($selected_district) {
    $districts = ["Ampara","Anuradhapura","Badulla","Batticaloa","Colombo","Galle","Gampaha","Hambantota","Jaffna","Kalutara","Kandy","Kegalle","Kilinochchi","Kurunegala","Mannar","Matale","Matara","Monaragala","Mullaitivu","Nuwara Eliya","Polonnaruwa","Puttalam","Ratnapura","Trincomalee","Vavuniya"];
    $text = "";
    foreach ($districts as $district) {
        if ($district == $selected_district) {
            $text .= '<option value="' . $district . '"'. "selected" .'>'. $district . '</option>';
        } 
        else {
            $text .= '<option value="' . $district . '"' .'>'. $district . '</option>';
        }
    }
    
    return $text;
}
function get_gender($selected_gender) {
    $genders = ["Male", "Female"];
    $text = "";
    foreach ($genders as $gender) {
        if ($gender == $selected_gender) {
            $text .= '<option value="' . $gender . '"'. "selected" .'>'. $gender . '</option>';
        } 
        else {
            $text .= '<option value="' . $gender . '"' .'>'. $gender . '</option>';
        }
    }
    
    return $text;
}
function get_blood_group($selected_blood) {
    $groups = ["A+", "A-", "B+", "B-", "AB+", "AB-", "O+","O-"];
    $text = "";
    foreach ($groups as $group) {
        if ($group == $selected_blood) {
            $text .= '<option value="' . $group . '"'. "selected" .'>'. $group . '</option>';
        } 
        else {
            $text .= '<option value="' . $group . '"' .'>'. $group . '</option>';
        }
    }
    
    return $text;
}