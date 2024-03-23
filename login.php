<?php
$topic = "MedSync Login";
include_once "./site_parts/web_custom_header.php";
require "site_parts/getters.php";
?>

<div class="form_header navbar-spacing">

    <h2 class="text-center mt-3">User LogIn</h2>
    <div class="alert alert-primary mb-4 mt-3 inside-content" role="alert">
        <b>Instructions</b>
        <p class="m-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique voluptatibus
            perspiciatis
            consequuntur
            beatae quis ratione aliquam praesentium dolore tempore? Cumque mollitia voluptates aliquid quidem
            fugit?
        </p>
    </div>
    <?php
    add_alerts();
    ?>
</div>

<section class="user_info">
    <?php 
        include_once "site_parts/getters.php";
        ?>
    <div class="login-content card-animation">
        <form validate method="post" action="./includes/user_login.inc.php">
            <div class="from_div_content row g-3 needs-validation">
                <div class="col-md-12">
                    <label for="validationCustom01" class="form-label"><?=required_star()?> User ID / NIC</label>
                    <input type="text" class="form-control form-control-sm" id="validationCustom01" required
                        name="username" />
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01" class="form-label"><?=required_star() ?> Password</label>
                    <input type="password" class="form-control form-control-sm" id="validationCustom01" required
                        name="password" />
                </div>


                <div class="col-md-12 mt-4">
                    <button class="btn btn-primary form-control" style="width: 100%;" type="submit"
                        name="user_submission">
                        Log In
                    </button>
                </div>

            </div>
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

<?php
include_once "./site_parts/web_custom_footer.php";
?>