<?php

require_once("auth/config.php");

if (isset($_POST["deposit"])) {
    if (($resultMsg = AccountHandler::depositAction($conn, $_POST["amount"], $stringDate, $accountId)) === true) {
        $successMsg = "You added $" . $_POST["amount"] . " to your bank account";
    } else {
        $errorMsg = $resultMsg;
    }
}

$title = "Deposit";

?>

<?php require_once("layout/header.php"); ?>
<div class="text-center mt-5">
    <a href="index.php" class="btn btn-primary w-25">Back</a>
</div>
<div class="row justify-content-center mt-5">
    <div class="col-lg-6 text-center">
        <?php
        if (!empty($successMsg)) {
            echo MessageHandler::successMsg($successMsg);
        }
        if (!empty($errorMsg)) {
            echo MessageHandler::errorMsg($errorMsg);
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
            <div class="form-group">
                <input type="number" name="amount" id="amount" class="form-control" min="0" step="50" placeholder="Amount" required>
            </div>
            <div class="form-group">
                <input type="submit" name="deposit" id="deposit" value="Deposit" class="btn btn-dark w-100">
            </div>
        </form>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
