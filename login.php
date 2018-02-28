<?php

$restrict = true;

require_once("auth/config.php");

$title = "Login";

?>

<?php require_once("layout/header.php"); ?>
<div class="row justify-content-md-center">
    <div class="col-lg-6">
        <div class="text-center m-5">
            <img src="assets/images/main/atm.svg" height="200px" width="auto">
        </div>
        <?php
        echo AccountHandler::loginCustomer($conn);
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
            <div class="form-group">
                <input type="text" class="form-control" name="identityCard" id="identityCard" placeholder="Identity Card" autofocus required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <input type="submit" class="btn bg-dark text-light w-100" name="login" value="Submit">
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
