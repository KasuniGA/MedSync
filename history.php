<?php
session_start();
if (!(isset($_SESSION["doctor"]) && $_SESSION["role"] == "doctor")) {
    header("Location: ./index.php");
}
$title = "Patient History";
$web_title = "Patient History";
include_once "site_parts/dash_header.php";
$json_path = "config/credentials.json";
require "db.php";
require "site_parts/getters.php";
require "includes/functions.inc.php";
add_alerts();
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Main sections</h4>
    <?php
    if (isset($_SESSION["patient"])) {
        ?>
    <button class="btn btn-primary" data-bs-toggle="modal" type="button" data-bs-target="#new_record_model">New
        Main
        Record</button>
    <?php
    }
    ?>
</div>

<?php
    if (isset($_SESSION["patient"])) {
    ?>

<!-- Modal -->
<div class="modal fade" id="new_record_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="./includes/add_sections.inc.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fill this to create a new record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="model-wrapper">
                        <label class="form-label"><?=required_star() ?> Topic</label>
                        <input type="text" class="form-control form-control-sm" required name="topic" />
                    </div>
                    <div class="model-wrapper mt-2">
                        <label class="form-label"><?=required_star() ?> Description</label>
                        <input type="text" class="form-control form-control-sm" required name="description" />
                        <input type="text" value="<?=generateRandomKey() ?>" hidden class="form-control form-control-sm"
                            required name="key" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="new_main_record" class="btn btn-primary">Add Main Record</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
    }
    ?>

<section class="">
    <?php
    if (isset($_SESSION["patient"])) {
    ?>
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <?php 
        $docs = get_all_docs();
        $report_data = get_reports($_SESSION["patient"]["uid"]);
        if ($report_data) {
            foreach ($report_data as $key => $value) {
                $doctor = $docs[$value["doctor"]]["first_name"] . ' ' . $docs[$value["doctor"]]["last_name"];
                ?>
        <div class="accordion-item" style="border: 2px solid lightgray;">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    style="display: flex; justify-content: space-between; width: 100%; align-items:center; position: relative;"
                    data-bs-target="#panel-<?=$key ?>" aria-expanded="false" aria-controls="panel-<?=$key ?>">
                    <div style="display: flex; justify-content: space-between; align-items:center;">
                        <?php 
                        if ($value["status"] == "Stable") {
                            ?>
                        <span class="badge text-bg-warning fix-badge me-3"><?=$value["status"] ?></span>
                        <?php
                        } 
                        else if ($value["status"] == "Active") {
                            ?>
                        <span class="badge text-bg-success fix-badge me-3"><?=$value["status"] ?></span>
                        <?php
                        } 
                        else if ($value["status"] == "Inactive") {
                        ?>
                        <span class="badge text-bg-danger fix-badge me-3"><?=$value["status"] ?></span>
                        <?php
                        }
                        else {
                        ?>
                        <span class="badge text-bg-info fix-badge me-3"><?=$value["status"] ?></span>
                        <?php
                        }
                        ?>

                        <?=$value["topic"] ?>
                    </div>
                    <p style="position: absolute; right: 60px;" class="m-0"><?=ts_to_date($value["ts"]) ?></p>
                </button>
            </h2>
            <div id="panel-<?=$key ?>" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="alert alert-success" role="alert">
                        <p class="mb-4"><?=$value["description"] ?></p>

                        <p class="m-0">Created by <b>Dr. <?=$doctor ?></b></p>
                        <p class="m-0"><span class="badge text-bg-primary"><?=ts_to_date($value["ts"]) ?></span></p>

                        <div class="booking-btn-align d-flex mt-4">
                            <form action="./includes/add_sections.inc.php" method="POST">
                                <input type="text" hidden value="<?=$key ?>" name="main_key">
                                <input type="text" hidden value="<?=$_SESSION["patient"]["uid"] ?>" name="patient">
                                <input type="text" hidden value="Active" name="status">
                                <button type="submit" class="btn btn-success" name="main_section_status">Active</button>
                            </form>
                            <form action="./includes/add_sections.inc.php" method="POST">
                                <input type="text" hidden value="<?=$key ?>" name="main_key">
                                <input type="text" hidden value="<?=$_SESSION["patient"]["uid"] ?>" name="patient">
                                <input type="text" hidden value="Inactive" name="status">
                                <button type="submit" class="btn btn-danger mx-2"
                                    name="main_section_status">Inactive</button>
                            </form>
                            <form action="./includes/add_sections.inc.php" method="POST">
                                <input type="text" hidden value="<?=$key ?>" name="main_key">
                                <input type="text" hidden value="<?=$_SESSION["patient"]["uid"] ?>" name="patient">
                                <input type="text" hidden value="Stable" name="status">
                                <button type="submit" class="btn btn-warning" name="main_section_status">Stable</button>
                            </form>
                        </div>
                    </div>


                    <div class="defalt-container-mod">
                        <h6>Add new sub report here</h6>
                        <form action="./includes/add_sections.inc.php" method="POST" enctype="multipart/form-data">
                            <div class="model-wrapper">
                                <label class="form-label"><?=required_star() ?> Topic</label>
                                <input type="text" class="form-control form-control-sm" required name="sub_topic" />
                            </div>
                            <div class="model-wrapper mt-2">
                                <label class="form-label"><?=required_star() ?> Description</label>

                                <textarea style="border: 2px solid var(--input-color);" class="form-control"
                                    name="sub_description" placeholder="Write Here" id="floatingTextarea"
                                    required></textarea>

                                <input type="text" value="<?=generateRandomKey() ?>" hidden
                                    class="form-control form-control-sm" required name="sub_key" />
                                <input type="text" value="<?=$key ?>" hidden class="form-control form-control-sm"
                                    required name="main_key" />
                            </div>
                            <div class="model-wrapper mt-2">
                                <label class="form-label"><?=required_star() ?> Type</label>
                                <select style="border: 2px solid var(--input-color)" class="form-select form-select-sm"
                                    id="validationCustom04" required name="type">
                                    <?=get_report_type("")?>
                                </select>
                            </div>
                            <div class="model-wrapper mt-2">
                                <label for="formFileSm" class="form-label"><?=required_star() ?> Upload Images</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="images[]"
                                    multiple accept="image/jpeg, image/png" max="5">
                            </div>
                            <div class="d-flex justify-content-start mt-2">
                                <button type="submit" name="new_sub_record" class="btn btn-primary d-end">Add Sub
                                    Record</button>
                            </div>
                        </form>
                    </div>
                    <!-- scroll spy -->
                    <?php 
                    if (isset($value["content"])) {
                    ?>
                    <hr class="my-4">
                    <h5 class="my-4">Sub Records</h5>
                    <div class="accordion" id="accordionPanels">
                        <?php
                    foreach ($value["content"] as $sub_key => $sub_value) {
                        $sub_doctor = $docs[$sub_value["doctor"]]["first_name"] . ' ' . $docs[$sub_value["doctor"]]["last_name"];
                        ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    style="display: flex; justify-content: space-between; width: 100%; align-items:center; position: relative;"
                                    data-bs-target="#sub_panel_<?=$sub_key ?>" aria-expanded="false"
                                    aria-controls="sub_panel_<?=$sub_key ?>">
                                    <p class="m-0"><?=$sub_value["topic"] ?></p>
                                    <p style="position: absolute; right: 60px;" class="m-0">
                                        <?=ts_to_date($sub_value["ts"]) ?></p>
                                </button>
                            </h2>
                            <div id="sub_panel_<?=$sub_key ?>" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <div class="alert alert-primary" role="alert">
                                        <p class="m-0">Created by <b>Dr. <?=$sub_doctor ?></b></p>
                                        <p class="m-0"><span
                                                class="badge text-bg-primary"><?=ts_to_date($sub_value["ts"]) ?></span>
                                        </p>
                                    </div>
                                    <p>
                                        <?=$sub_value["description"] ?>
                                    </p>
                                    <?php
                                    if (isset($sub_value["images"])) {
                                    ?>
                                    <div class="image-container">
                                        <?php 
                            
                                foreach ($sub_value["images"] as $image) {
                                   ?>

                                        <img src="./img/<?=$image ?>" class="img-fluid mx-2" alt="...">

                                        <?php
                            }
                        }
                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <?php
                    }
                    ?>
                    <!-- scroll spy -->

                </div>
            </div>
        </div>

        <?php
            }
        }
        else {
            echo "No data exists";
        }
        ?>
    </div>
    <?php
    } else {
        echo "Search the patient first and then come back";
    }
    ?>
</section>





<?php
// include_once "site-parts/footer_part.php";
include_once "site_parts/dash_footer.php";
?>