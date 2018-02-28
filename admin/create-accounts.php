<?php

require_once("auth/config.php");

$options = CustomerHandler::checkCustomers($conn);

$title = "Create Accounts";

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Create Accounts</h2>
</div>
<?php
echo AccountHandler::addAccount($conn, $stringDate);
if (!empty($options)) { ?>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off">
        <div class="form-group">
            <select name="customerId" id="customerId" class="form-control">
                <option selected disabled>Select Customer</option>
                <?php echo $options; ?>
            </select>
        </div>
        <div class="form-group">
            <select name="typeAccount" id="typeAccount" class="form-control">
                <option selected disabled>Select Type Account</option>
                <option value="private">Private</option>
                <option value="business">Business</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" name="addAccount" id="addAccount" class="btn btn-success w-100" value="Add Account">
        </div>
    </form>
<?php } else {
    MessageHandler::warningMsg("There are no customers in the bank yet");
} ?>
<?php require_once("layout/footer.php"); ?>
