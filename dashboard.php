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
// get_jambo("https://assets-global.website-files.com/5f4bb8e34bc82700bda2f385/60592b7ebe1b7639868b5190_learning-web-design-sites.jpg", "Welcome, ".$_SESSION["user"]["first_name"]." ". $_SESSION["user"]["last_name"] . "!", "This is the " .$_SESSION["role"]. " portal of the College Of Alexandriana");
?>

<!-- STUDENT PART -->

<h4 class="mb-4 mt-5">Registered Classes</h4>
<div class="container">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <!-- Card 1 -->
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
</div>
<br>


<?php
// include_once "site-parts/footer_part.php";
include_once "site_parts/dash_footer.php";
?>