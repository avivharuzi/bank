<?php

require_once("auth/config.php");

$title = "Withdrawal";

?>

<?php require_once("layout/header.php"); ?>
<div class="text-center mt-5">
    <a href="index.php" class="btn btn-primary w-25">Back</a>
</div>
<div class="row justify-content-center mt-5">
    <div class="col-lg-6 text-center">
        <?php
        echo AccountHandler::withdrawal($conn, $stringDate, $accountId);
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
            <div class="form-group">
                <input type="number" name="amount" id="amount" class="form-control" min="0" step="50" placeholder="Amount" required>
            </div>
            <div class="form-group">
                <input type="submit" name="withdrawal" id="withdrawal" value="Withdrawal" class="btn btn-dark w-100">
            </div>
        </form>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
