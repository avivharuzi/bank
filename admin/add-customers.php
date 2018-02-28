<?php

require_once("auth/config.php");

$title = "Add Customers";

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Add Customers</h2>
</div>
<?php
echo CustomerHandler::addCustomer($conn);
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off" id="addCustomerFrom">
    <div id="addCustomerErrors" class='alert alert-danger text-center'>
        <p class='lead' id='errFullName'><i class='fa fa-exclamation-circle mr-2'></i>Full name is invalid</p>
        <p class='lead' id='errUserName'><i class='fa fa-exclamation-circle mr-2'></i>User name is invalid at least 3 characters</p>
        <p class='lead' id='errIdentityCard'><i class='fa fa-exclamation-circle mr-2'></i>Identity card is invalid only 9 numbers</p>
    </div>
    <div class="form-group">
        <input type="text" name="fullName" id="fullName" class="form-control"
        value="<?php echo ValidationHandler::preserveValue("fullName") ?>" placeholder="Full Name" required>
    </div>
    <div class="form-group">
        <input type="text" name="userName" id="userName" class="form-control"
        value="<?php echo ValidationHandler::preserveValue("userName") ?>" placeholder="User Name" required>
    </div>
    <div class="form-group">
        <input type="text" name="identityCard" id="identityCard" class="form-control"
        value="<?php echo ValidationHandler::preserveValue("identityCard") ?>" placeholder="Identity Card" required>
    </div>
    <div class="form-group">
        <input type="submit" name="addCustomer" id="addCustomer" class="btn btn-success w-100" value="Add Customer">
    </div>
</form>
<?php require_once("layout/footer.php"); ?>
