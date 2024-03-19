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
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panel-<?=$key ?>" aria-expanded="true" aria-controls="panel-<?=$key ?>">
                    <?=$value["topic"] ?>
                </button>
            </h2>
            <div id="panel-<?=$key ?>" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="alert alert-success" role="alert">
                        <?=$value["description"] ?>
                    </div>
                    <div>
                        <p class="m-0">Created by <b>Dr. <?=$doctor ?></b></p>
                        <p class="m-0">Created Date and Time: <span
                                class="badge text-bg-primary"><?=ts_to_date($value["ts"]) ?></span></p>
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
                                <label for="formFileSm" class="form-label"><?=required_star() ?> Upload Images</label>
                                <input class="form-control form-control-sm" id="formFileSm" type="file" name="images[]"
                                    required multiple accept="image/jpeg, image/png" max="5">
                            </div>
                            <div class="d-flex justify-content-start mt-2">
                                <button type="submit" name="new_sub_record" class="btn btn-primary d-end">Add Sub
                                    Record</button>
                            </div>
                        </form>
                    </div>

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