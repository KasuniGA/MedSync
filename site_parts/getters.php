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
function get_relationship_status($selected_status) {
    $groups = ["Single", "Married", "Partner", "Separated", "Unknown", "Widowed"];
    $text = "";
    foreach ($groups as $group) {
        if ($group == $selected_status) {
            $text .= '<option value="' . $group . '"'. "selected" .'>'. $group . '</option>';
        } 
        else {
            $text .= '<option value="' . $group . '"' .'>'. $group . '</option>';
        }
    }
    
    return $text;
}
function get_report_type($report_type) {
    $groups = ["Prescription","Referral Letter", "Diagnosis","Treatment Plan", "Lab Test Result", "Surgery","Imaging Test Result", "Therapy Session Notes", "Follow-up Instructions", "Medical Procedure", "Medical History", "Immunization Record"];
    $text = "";
    foreach ($groups as $group) {
        if ($group == $report_type) {
            $text .= '<option value="' . $group . '"'. "selected" .'>'. $group . '</option>';
        } 
        else {
            $text .= '<option value="' . $group . '"' .'>'. $group . '</option>';
        }
    }
    
    return $text;
}
function add_alerts() {
    
    if (isset($_GET["err"])) {
     ?>
<div class="alert alert-danger alert-dismissible fade show inside-content mb-4" role="alert">
    <p style="text-align: center; margin: 0;"><strong>Warning! &nbsp;</strong><?=$_GET["err"]?></p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
        }
 
       
    if (isset($_GET["ok"])) {
     ?>
<div class="alert alert-success alert-dismissible fade show inside-content mb-4" role="alert">
    <p style="text-align: center; margin: 0;"><strong>Looking Good! &nbsp;</strong><?=$_GET["ok"]?></p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php
}
}

function get_jambo($url, $topic, $description)
{
    ?>
<section class="jambo-container-style"
    style="position:relative; background: url('<?=$url; ?>'); background-position: center; background-repeat: no-repeat; background-size: cover; padding: 0; border-radius: 20px; overflow: hidden;">
    <div style="width:100%; height:100%; background-color: rgba(0, 0, 0, 0.4);">
        <div class="text-white rounded" style="padding: 100px 50px">
            <h1 style="color:white;">
                <?=$topic; ?>
            </h1>
            <p>
                <?=$description; ?>
            </p>
        </div>
    </div>
</section>
<?php
}

function get_age($dob) {
    $dobDate = new DateTime($dob);
    $currentDate = new DateTime();
    $ageInterval = $dobDate->diff($currentDate);
    $age = $ageInterval->y;
    
    return $age;
}

function ts_to_date($timestamp) {
    return date("Y-m-d H:i:s", $timestamp);
}