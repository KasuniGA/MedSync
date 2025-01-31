<?php
session_start();
if (!isset($_SESSION["role"])) {
    header("Location: ./index.php");
}
$title = "Dashboard";
$web_title = "Dashboard";
include_once "site_parts/dash_header.php";
$json_path = "config/credentials.json";
require "db.php";
require "site_parts/getters.php";
add_alerts();
if (!isset($_SESSION["role"])) {
    header("Location: ../index.php");
}
// get_jambo("https://assets-global.website-files.com/5f4bb8e34bc82700bda2f385/60592b7ebe1b7639868b5190_learning-web-design-sites.jpg", "Welcome, ".$_SESSION["user"]["first_name"]." ". $_SESSION["user"]["last_name"] . "!", "This is the " .$_SESSION["role"]. " portal of the College Of Alexandriana");
?>

<section class="mb-5">
    <?php
    if (isset($_SESSION["user"])) {
        ?>
    <div class="alert alert-primary mb-4 inside-content" role="alert">
        <p class="mb-2"><b>Instructions</b></p>
        <p class="m-0">You can now obtain your User ID card from any hospital. Simply visit your nearest hospital and
            request the MedSync User ID card. They will provide you with the ID card, and a digital copy will also be
            sent to the email address you provided. Remember, you can only change your email on the Profile page.</p>
    </div>
    <?php
    }
get_jambo("https://img.freepik.com/free-photo/stethoscope-copy-space_23-2147652347.jpg", "Welcome " . $_SESSION[$_SESSION["role"]]["first_name"] . " " . $_SESSION[$_SESSION["role"]]["last_name"], "We seamlessly connect you with providers through innovative technology, ensuring a caring and healthier future for you...");
?>
</section>

<?php 
if ((isset($_SESSION["doctor"]) && $_SESSION['role'] == "doctor")) {
?>
<div class="container d-flex justify-content-between align-items-center">
    <h4 class="">Actions</h4>
    <?php
    if (isset($_SESSION["patient"])) {
    ?>
    <form method="post" action="./includes/search_patient.inc.php">
        <button class="btn btn-danger" name="forget_patient" type="submit">Close Patient Session</button>
    </form>
    <?php
    }
    ?>
</div>
<div class="defalt-container-mod">
    <form validate method="post" action="./includes/search_patient.inc.php">
        <label class="form-label"><?=required_star()?> Patient ID</label>
        <div class="from_div_content row g-3 needs-validation align-items-center">
            <div class="col-md-6">
                <input type="text" id="modalText2" class="form-control form-control-sm" required name="patient_id" <?php
                if (isset($_SESSION["patient"])) {
                    echo 'value="' . $_SESSION["patient"]["uid"] . '"';
                }
                ?> />
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary form-control" type="submit" name="search_patient">
                    Search
                </button>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success form-control" data-bs-toggle="modal"
                    data-bs-target="#scannerModal">
                    Scan QR
                </button>
            </div>
        </div>
    </form>
</div>

<div class="conatiner defalt-container-mod">

    <?php 
if (!isset($_SESSION["patient"])) {
    ?>
    <div class="row">
        <div class="col-md-12">Please search the patient to get the details</div>
    </div>
    <?php
}
else {
?>
    <div class="row">
        <h5 class="mb-4"><?=required_star()?> Patient Basic Infomation (<?=$_SESSION["patient"]["uid"] ?>)</h5>
        <div class="col-md-6">
            <p>Patient Name: <b><?=$_SESSION["patient"]["first_name"] ?> <?=$_SESSION["patient"]["last_name"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Patient Full Name: <b><?=$_SESSION["patient"]["full_name"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Patient NIC: <b><?=$_SESSION["patient"]["nic"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Patient Age: <b><?=get_age($_SESSION["patient"]["dob"]) ?> Years Old</b></p>
        </div>
        <div class="col-md-6">
            <p>Patient Gender: <b><?=$_SESSION["patient"]["gender"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Patient DOB: <b><?=$_SESSION["patient"]["dob"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Blood Group: <span class="badge text-bg-primary"><?=$_SESSION["patient"]["blood"] ?></span> </p>
        </div>
        <div class="col-md-6">
            <p>Patient Phone: <b><?=$_SESSION["patient"]["phone"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Patient Email: <b><?=$_SESSION["patient"]["email"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Relationship Status: <b><?=$_SESSION["patient"]["relationship"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Occupation: <b><?=$_SESSION["patient"]["occupation"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Patient Address: <b><?=$_SESSION["patient"]["address_l1"] ?>, <?=$_SESSION["patient"]["address_l2"] ?>,
                    <?=$_SESSION["patient"]["district"] ?></b></p>
        </div>
        <hr class="my-4">

        <h5 class="my-4"><?=required_star()?> Emergency Contact Information</h5>
        <div class="col-md-6">
            <p>Name of Emergency Contact: <b><?=$_SESSION["patient"]["first_name"] ?>
                    <?=$_SESSION["patient"]["emg_name"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Relationship to Patient: <b><?=$_SESSION["patient"]["rel_name"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Emergency Contact Number: <b><?=$_SESSION["patient"]["emg_phone"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Emergency Contact Address: <b><?=$_SESSION["patient"]["emg_address_l1"] ?>,
                    <?=$_SESSION["patient"]["emg_address_l2"] ?>, <?=$_SESSION["patient"]["emg_district"] ?></b></p>
        </div>
        <hr class="my-4">
        <h5 class="my-4"><?=required_star()?> Medical Conditions</h5>
        <div class="col-md-6">
            <p>Allergies: <b><?=$_SESSION["patient"]["med_allergy"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Surgeries: <b><?=$_SESSION["patient"]["med_surgery"] ?></b></p>
        </div>
        <div class="col-md-6">
            <p>Chronic Conditions: <b><?=$_SESSION["patient"]["med_chronic"] ?></b></p>
        </div>
    </div>

    <?php 
    }
    ?>
</div>



<!-- Modal -->
<div class="modal fade" id="scannerModal" tabindex="-1" aria-labelledby="scannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scannerModalLabel">QR Scanner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="preview">
                    <video id="modalPreview" width="100%"></video>
                </div>
                <input type="text" id="modalText" class="form-control mt-3" placeholder="Scan result">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<?php
}
?>


<?php
if ((isset($_SESSION["user"]) && $_SESSION['role'] == "user")) { 
    ?>

<?php
    require "includes/functions.inc.php";
    $main_report_count = 0;
    $sub_report_count = 0;
    $active = 0;
    $stable = 0;
    $inactive = 0;
    $surgery_count = 0;
    $report_data = get_reports($_SESSION["user"]["uid"]);
    ?>
<section>
    <?php
    if ($report_data) {
        foreach ($report_data as $key => $value) {
            $main_report_count += 1;
            if ($value["status"] == "Stable") {
                $stable += 1;
            } 
            else if ($value["status"] == "Active") {
                $active += 1;   
            } 
            else if ($value["status"] == "Inactive") {
                $inactive += 1;
            }
            if (isset($value["content"])) {
                foreach ($value["content"] as $sub_key => $sub_value) {
                    $sub_report_count += 1;
                    
                    if ($sub_value["type"] == "Surgery") {
                        $surgery_count += 1;
                    }
                }
            }
        }
    
    ?>
    <?php
    $active_progress = $active / $main_report_count * 100;
    $stable_progress = $stable / $main_report_count * 100;
    $inactive_progress = $inactive / $main_report_count * 100;
      ?>
    <h4 class="mt-4 mb-3">Status Report</h4>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-2 ">
                <div class="card">
                    <div class="card-body d-flex justify-content-evenly align-items-center">
                        <div class="progress pro-active" style="--percentage: <?=$active_progress?>%;">
                            <span class="progress-text"><?=$active_progress?>% </span>
                        </div>
                        <p><b>Active</b></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="card">
                    <div class="card-body d-flex justify-content-evenly align-items-center">
                        <div class="progress pro-stable" style="--percentage: <?=$stable_progress?>%;">
                            <span class="progress-text"><?=$stable_progress?>% </span>
                        </div>
                        <p><b>Stable</b></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-2">
                <div class="card">
                    <div class="card-body d-flex justify-content-evenly align-items-center">
                        <div class="progress pro-inactive" style="--percentage: <?=$inactive_progress?>%;">
                            <span class="progress-text"><?=$inactive_progress?>% </span>
                        </div>
                        <p><b>Inactive</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <p>Total Main Reports: <b><?=$main_report_count ?></b></p>
        <p>Total Sub Reports: <b><?=$sub_report_count ?></b></p>
        <p>Total Surgeries: <b><?=$surgery_count ?></b></p>
    </div>
    <?php }
    else {
        echo "No data exists";
    } ?>

</section>
<?php } ?>


<!-- QR Scanner -->
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
let modalScanner = new Instascan.Scanner({
    video: document.getElementById('modalPreview')
});

function startModalScanner() {
    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            modalScanner.start(cameras[0]);
        } else {
            alert("No Cameras found");
        }
    }).catch(function(e) {
        console.error(e);
    });
}

modalScanner.addListener('scan', function(content) {
    document.getElementById('modalText').value = content;
    document.getElementById('modalText2').value = content;
});

document.getElementById('scannerModal').addEventListener('shown.bs.modal', function() {
    startModalScanner();
});

document.getElementById('scannerModal').addEventListener('hidden.bs.modal', function() {
    modalScanner.stop();
});
</script>




<?php
// include_once "site-parts/footer_part.php";
include_once "site_parts/dash_footer.php";
?>