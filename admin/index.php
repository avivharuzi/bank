<?php

require_once("auth/config.php");

$title = "Home";

?>

<?php require_once("layout/header.php"); ?>
<div class="row justify-content-center mt-5">
    <div class="col-lg-6">
        <div class="jumbotron">
            <h2>CUSTOMERS <span class="badge badge-primary ml-3"><?php echo CustomerHandler::getNumberOfCustomers($conn); ?></span></h2>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="jumbotron">
            <h2>BANK ACCOUNTS <span class="badge badge-primary ml-3"><?php echo AccountHandler::getNumberOfAccounts($conn); ?></span></h2>
        </div>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
