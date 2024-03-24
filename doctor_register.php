<?php
$topic = "Doctor Registration";
include_once "./site_parts/web_custom_header.php";
include_once "site_parts/getters.php";

?>
<div class="form_header navbar-spacing">

    <h2 class="text-center mt-3">Doctor Registration Forum</h2>
    <div class="alert alert-primary mb-4 mt-3 inside-content" role="alert">
        <b>Instructions</b>
        <p class="m-0">You can register as a doctor in here</p>
    </div>
    <?php
    add_alerts();
    ?>
</div>
<section class="user_info">
    <div class="inside-content">
        <form validate method="post" action="./includes/doc_register.inc.php">
            <h5 class="mb-2"><?=required_star()?> Personal Information</h5>
            <div class="from_div_content row g-3 needs-validation">
                <div class="col-md-12">
                    <label for="validationCustom01" class="form-label"><?=required_star()?> Full
                        Name</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom01" required
                        name="full-name" />
                </div>
                <div class="col-md-6">
                    <label for="validationCustom01" class="form-label"><?=required_star() ?> First name</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom01" required
                        name="f-name" />
                </div>
                <div class="col-md-6">
                    <label for="validationCustom02" class="form-label"><?=required_star() ?> Last name</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom02" required
                        name="l-name" />
                </div>
                <div class="col-md-6">
                    <label for="validationCustom04" class="form-label"><?=required_star() ?> Gender</label>
                    <select style="border: 2px solid rgb(208, 161, 255)" class="form-select form-select-sm"
                        id="validationCustom04" required name="gender">
                        <?=get_gender("")?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label"><?=required_star() ?> Birthday</label>
                    <input type="date" class="form-control form-control-sm" id="validationCustom03" required
                        name="dob" />
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label"><?=required_star() ?> NIC</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                        name="nic" />
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label"><?=required_star() ?> MBBS ID</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                        name="mbbs" />
                </div>
                <div class="col-md-4">
                    <label for="validationCustom03" class="form-label"><?=required_star() ?> Address Line
                        1</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                        name="address-1" />
                </div>
                <div class="col-md-4">
                    <label for="validationCustom03" class="form-label"><?=required_star() ?> Address Line
                        2</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                        name="address-2" />
                </div>
                <div class="col-md-4">
                    <label for="validationCustom04" class="form-label"><?=required_star() ?> District</label>
                    <select style="border: 2px solid rgb(208, 161, 255)" class="form-select form-select-sm"
                        id="validationCustom04" required name="district">
                        <!-- add the districts -->
                        <?=get_districts("")?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label"><?=required_star()?> Phone
                        number</label>
                    <input type="number" class="form-control form-control-sm" id="validationCustom03" required
                        name="p-num" />
                </div>
                <div class="col-md-6">
                    <label for="validationCustom05" class="form-label"><?=required_star() ?> Email
                        Address</label>
                    <input type="email" class="form-control form-control-sm" id="validationCustom05" required
                        name="e-mail" />
                </div>
            </div>
            <h5 class="mt-5 pb-2"><?=required_star() ?> Add a Password for your Account</h5>
            <div class="from_div_content row g-3 needs-validation mb-4">
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label"><?=required_star() ?> Password</label>
                    <input type="password" class="form-control form-control-sm" id="validationCustom03" required
                        name="password" />
                </div>
                <div class="col-md-6">
                    <label for="validationCustom03" class="form-label"><?=required_star() ?> Repeat
                        Password</label>
                    <input type="password" class="form-control form-control-sm" id="validationCustom03" required
                        name="password_rep" />
                </div>
            </div>
            <div class="from_div_content row g-3 needs-validation mt-4 mb-2">
                <div class="col-12">
                    <button class="btn btn-primary form-control" type="submit" name="doc_submission">
                        Register
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>


<?php
include_once "./site_parts/web_custom_footer.php";
?>