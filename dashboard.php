<?php
session_start();
$title = "Dashboard";
$web_title = "Dashboard";
include_once "site_parts/dash_header.php";
$json_path = "config/credentials.json";
include("db.php");
?>
<?php
require "site_parts/getters.php";
add_alerts();
// get_jambo("https://assets-global.website-files.com/5f4bb8e34bc82700bda2f385/60592b7ebe1b7639868b5190_learning-web-design-sites.jpg", "Welcome, ".$_SESSION["user"]["first_name"]." ". $_SESSION["user"]["last_name"] . "!", "This is the " .$_SESSION["role"]. " portal of the College Of Alexandriana");
?>

<!-- STUDENT PART -->

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
<!-- <div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <div class="col">
            <div class="card card-animation">
                <div class="card-body">
                    <h5 class="card-title">subject theory (2020)
                    </h5>
                    <p class="card-text mb-0" style="color: rgba(143, 0, 219);">name name</p>
                    <p class="mb-0">Every day from 9.00 to 10.00 @ Hall 009</p>
                    <p class="mt-0">
                        <span class="badge text-bg-primary mt-0">Grade 11</span>
                        <span class="badge text-bg-primary mt-0">Sinhala Medium</span>
                        <span class="badge text-bg-warning mt-0">1000 LKR</span>
                    </p>
                    <div class="mt-4" style="width: 100%; display: flex; justify-content: end;">
                        <a class="btn btn-sm btn-success" style="width: 100%;" target="_blank"
                            href="https://google.com">Join Class Group</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->


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