<?php
$topic = "User Registration";
include_once "./site_parts/web_custom_header.php";
include_once "site_parts/getters.php";
?>
<div class="form_header navbar-spacing">

    <h2 class="text-center mt-3">User Registration Forum</h2>
    <div class="alert alert-primary mb-4 mt-3 inside-content" role="alert">
        <p class="mb-2"><b>Instructions</b></p>
        <p class="m-0">Fill all the required fields. If you don't have a NIC, just keep it empty.</p>
        <p class="m-0">You need to give the same password twise for reduce the type errors</p>
    </div>
    <?php
    add_alerts();
    ?>
</div>
<section class="user_info">
    <div class="inside-content">
        <form validate method="post" action="./includes/user_register.inc.php">
            <h5 class="mb-2"><?=required_star()?> Personal Information</h5>
            <div class="from_div_content row g-3 needs-validation">
                <div class="col-md-12">
                    <label class="form-label"><?=required_star()?> Full
                        Name</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom01" required
                        name="full-name" />
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star() ?> First name</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom01" required
                        name="f-name" />
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star() ?> Last name</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom02" required
                        name="l-name" />
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star() ?> Gender</label>
                    <select style="border: 2px solid rgb(208, 161, 255)" class="form-select form-select-sm"
                        id="validationCustom04" required name="gender">
                        <?=get_gender("")?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star() ?> Birthday</label>
                    <input type="date" class="form-control form-control-sm" id="validationCustom03" required
                        name="dob" />
                </div>
                <div class="col-md-6">
                    <label class="form-label">NIC</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom03" name="nic" />
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star() ?> Blood Group</label>
                    <select style="border: 2px solid rgb(208, 161, 255)" class="form-select form-select-sm"
                        id="validationCustom04" required name="b-grp">
                        <?=get_blood_group("") ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label"><?=required_star() ?> Address Line
                        1</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                        name="address-1" />
                </div>
                <div class="col-md-4">
                    <label class="form-label"><?=required_star() ?> Address Line
                        2</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                        name="address-2" />
                </div>
                <div class="col-md-4">
                    <label class="form-label"><?=required_star() ?> District</label>
                    <select style="border: 2px solid rgb(208, 161, 255)" class="form-select form-select-sm"
                        id="validationCustom04" required name="district">
                        <!-- add the districts -->
                        <?=get_districts("")?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star()?> Phone
                        number</label>
                    <input type="number" class="form-control form-control-sm" id="validationCustom03" required
                        name="p-num" />
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star() ?> Email
                        Address</label>
                    <input type="email" class="form-control form-control-sm" id="validationCustom05" required
                        name="e-mail" />
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star()?> Relationship Status</label>
                    <select style="border: 2px solid rgb(208, 161, 255)" class="form-select form-select-sm"
                        id="validationCustom04" required name="relationship">
                        <?=get_relationship_status("") ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><?=required_star() ?> Occupation</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom05" required
                        name="occupation" />
                </div>
                <h5 class="mt-5 pb-2"><?=required_star() ?> Emergency Contact Information</h5>
                <div class="from_div_content row g-3 needs-validation mb-4">
                    <div class="col-md-12">
                        <label class="form-label"><?=required_star() ?> Name of Emergency
                            Contact
                        </label>
                        <input type="text" class="form-control form-control-sm" id="validationCustom01" required
                            name="emerg-name" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?=required_star() ?> Relationship to
                            Patient
                        </label>
                        <input type="text" class="form-control form-control-sm" id="validationCustom01" required
                            name="rel-name" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?=required_star() ?> Phone Number of
                            Emergency Contact
                        </label>
                        <input type="number" class="form-control form-control-sm" id="validationCustom02" required
                            name="emerg-pnum" />
                    </div>

                    <div class="col-md-4">
                        <label class="form-label"><?=required_star() ?> Address Line
                            1</label>
                        <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                            name="emerg-address-1" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><?=required_star() ?> Address Line
                            2</label>
                        <input type="text" class="form-control form-control-sm" id="validationCustom03" required
                            name="emerg-address-2" />
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><?=required_star() ?> District</label>
                        <select style="border: 2px solid rgb(208, 161, 255)" class="form-select form-select-sm"
                            id="validationCustom04" required name="emerg-district">
                            <!-- add the districts -->
                            <?=get_districts("")?>
                        </select>
                    </div>
                </div>
                <h5 class="mt-5 pb-2">Medical Conditions</h5>
                <div class="from_div_content row g-3 needs-validation mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Allergies</label>
                        <input type="text" class="form-control form-control-sm" id="validationCustom03"
                            name="med-allergy" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Surgeries</label>
                        <input type="text" class="form-control form-control-sm" id="validationCustom03"
                            name="med-surgery" />
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Chronic Conditions</label>
                        <input type="text" class="form-control form-control-sm" id="validationCustom03"
                            name="med-chronic" />
                    </div>
                </div>
                <h5 class="mt-5 pb-2"><?=required_star() ?> Add a Password for your Account</h5>
                <div class="from_div_content row g-3 needs-validation mb-4">
                    <div class="col-md-6">
                        <label class="form-label"><?=required_star() ?> Password</label>
                        <input type="password" class="form-control form-control-sm" id="validationCustom03" required
                            name="password" />
                    </div>
                    <div class="col-md-6">
                        <label class="form-label"><?=required_star() ?> Repeat
                            Password</label>
                        <input type="password" class="form-control form-control-sm" id="validationCustom03" required
                            name="password_rep" />
                    </div>
                </div>
                <div class="from_div_content row g-3 needs-validation mt-4 mb-2">
                    <div class="col-12">
                        <button class="btn btn-primary form-control" type="submit" name="user_submission">
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