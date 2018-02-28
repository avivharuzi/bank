<?php

require_once("auth/config.php");

$title = "Login";

?>

<?php require_once("layout/header.php"); ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="jumbotron text-center mt-5 bg-dark text-white">
            <h1>Log In</h1>
        </div>
        <?php
        echo AccountHandler::loginAdmin($conn);
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
            <div class="form-group">
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Username" autofocus required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary w-100" name="login" value="Submit">
            </div>
        </form>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
