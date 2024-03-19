<?php
session_start();
$title = "Patient History";
$web_title = "Patient History";
include_once "site_parts/dash_header.php";
$json_path = "config/credentials.json";
require "db.php";
require "site_parts/getters.php";
require "includes/functions.inc.php";
add_alerts();
?>
<div class="container d-flex justify-content-between align-items-center mb-4">
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

<section class="container">
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
                                <input type="text" class="form-control form-control-sm" required
                                    name="sub_description" />
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
                    <hr class="my-4">
                    <h5 class="my-4">Sub Records</h5>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                    aria-controls="panelsStayOpen-collapseOne">
                                    Accordion Item #1
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <strong>This is the first item's accordion body.</strong> It is shown by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    Accordion Item #2
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <strong>This is the second item's accordion body.</strong> It is hidden by default,
                                    until the collapse plugin adds the appropriate classes that we use to style each
                                    element. These classes control the overall appearance, as well as the showing and
                                    hiding via CSS transitions. You can modify any of this with custom CSS or overriding
                                    our default variables. It's also worth noting that just about any HTML can go within
                                    the <code>.accordion-body</code>, though the transition does limit overflow.
                                </div>
                            </div>
                        </div>
                    </div>
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