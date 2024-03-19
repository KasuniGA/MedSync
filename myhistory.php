<?php
session_start();
if (!(isset($_SESSION["user"]) && $_SESSION["role"] == "user")) {
    header("Location: ./index.php");
}
$title = "My History";
$web_title = "My History";
include_once "site_parts/dash_header.php";
$json_path = "config/credentials.json";
require "db.php";
require "site_parts/getters.php";
require "includes/functions.inc.php";
add_alerts();
?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Main sections</h4>
</div>


<section class="">
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <?php 
        $docs = get_all_docs();
        $report_data = get_reports($_SESSION["user"]["uid"]);
        if ($report_data) {
            foreach ($report_data as $key => $value) {
                $doctor = $docs[$value["doctor"]]["first_name"] . ' ' . $docs[$value["doctor"]]["last_name"];
                ?>
        <div class="accordion-item" id="sectionToPrint_<?=$key ?>" style="border: 2px solid lightgray;">
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
                    <button class="btn btn-warning my-2"
                        onclick="printSection('sectionToPrint_<?=$key ?>')">Print</button>

                    <div class="alert alert-success" role="alert">
                        <p class="mb-4"><?=$value["description"] ?></p>

                        <p class="m-0">Created by <b>Dr. <?=$doctor ?></b></p>
                        <p class="m-0"><span class="badge text-bg-primary"><?=ts_to_date($value["ts"]) ?></span></p>
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
                                <button class="accordion-button collapsed sub-accordion-button" type="button"
                                    data-bs-toggle="collapse"
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
</section>

<?php
$js_files = `<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>`;
?>
<script>
function printSection(sectionId) {
    var accordionButtons = document.querySelectorAll('.sub-accordion-button');
    accordionButtons.forEach(function(button) {
        button.click();
    });

    var content = document.getElementById(sectionId).innerHTML;
    var printWindow = window.open('', '_blank');


    var css_files = `<link rel="shortcut icon" href="imgs/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/dash.css">
    <link rel="stylesheet" href="./css/colors.css">`;



    printWindow.document.open();
    printWindow.document.write('<html><head><title>Print</title>');
    printWindow.document.write(css_files);
    printWindow.document.write('</head><body class="container mx-3">');
    printWindow.document.write(content);
    printWindow.document.write('</body>');
    printWindow.document.write(`</html>`);
    printWindow.document.close();
    printWindow.print();
}
</script>


<?php
// include_once "site-parts/footer_part.php";
include_once "site_parts/dash_footer.php";
?>