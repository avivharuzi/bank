<?php

$restrict = true;

require_once("auth/config.php");

if (isset($_POST["login"])) {
    $identityCard = $conn->escape($_POST["identityCard"]);
    $password     = $conn->escape($_POST["password"]);
    $sql = "SELECT * FROM customer WHERE IdentityCard = '$identityCard' LIMIT 1";
    $result = $conn->getSingleData($sql, "Customer");

    if ($result && $result->Password === $password) {
        if (($accountId = AccountHandler::checkAccount($conn, $result->Id)) !== false) {
                $result->setSession($accountId);
        } else {
            $errorMsg = "You are a bank customer but you still dont have an account";
        }
    } else {
        $errorMsg = "You have entered an invalid identity card or password";
    }
}

$title = "Login";

?>

<?php require_once("layout/header.php"); ?>
<div class="row justify-content-md-center">
    <div class="col-lg-6">
        <div class="text-center m-5">
            <img src="images/main/atm.svg" height="200px" width="auto">
        </div>
        <?php
        if (!empty($errorMsg)) {
            echo MessageHandler::errorMsg($errorMsg);
        }
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
