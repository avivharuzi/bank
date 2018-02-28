<?php

require_once("auth/config.php");

$title = "Home";

?>

<?php require_once("layout/header.php"); ?>
<div id="nav-atm">
    <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
            <a href="deposit.php" class="btn btn-outline-custom w-100"><i class="fa fa-plus mr-3"></i> Deposit</a>
        </div>
        <div class="col-lg-6 text-center">
            <a href="withdrawal.php" class="btn btn-outline-custom w-100"><i class="fa fa-minus mr-3"></i> Withdrawal</a>
        </div>
    </div>
    <div class="row justify-content-center mt-5">
        <div class="col-lg-12 text-center">
            <a href="print-recent-actions.php" class="btn btn-outline-custom w-100"><i class="fa fa-print mr-3"></i> Print Recent Actions</a>
        </div>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
