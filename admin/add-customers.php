<?php

require_once("auth/config.php");

$fullName = $userName = $identityCard = "";

if (isset($_POST["addCustomer"]) && count($_POST["addCustomer"]) > 0) {
    $regFullName     = "/^[a-zA-Z ]*$/";
    $regUserName     = "/^[A-Za-z0-9_]{3,20}$/";
    $regIdentityCard = "/^[0-9]{9}$/";

    $counter = 0;

    if (!ValidationHandler::validateInputs($_POST["fullName"], $regFullName)) {
        $counter += 1;
        $fullName = $_POST["fullName"];
    } else {
        $fullName = ValidationHandler::testInput(strtolower($_POST["fullName"]));
    }

    if (!ValidationHandler::validateInputs($_POST["userName"], $regUserName)) {
        $counter += 1;
        $userName = $_POST["userName"];
    } else {
        $userName = ValidationHandler::testInput(strtolower($_POST["userName"]));
        if (CustomerHandler::checkUserName($conn, $userName)) {
            $counter += 1;
            $errorMsg[] = "This user name is already in used";
        }
    }

    if (!ValidationHandler::validateInputs($_POST["identityCard"], $regIdentityCard)) {
        $counter += 1;
        $identityCard = $_POST["identityCard"];
    } else {
        $identityCard = ValidationHandler::testInput(strtolower($_POST["identityCard"]));
        if (CustomerHandler::checkIdentityCard($conn, $identityCard)) {
            $counter += 1;
            $errorMsg[] = "This identity card is already in used";
        }
    }

    if ($counter === 0) {
        $password = GenerateHandler::generatePassword();
        $customer = new Customer(null, $fullName, $userName, $password, $identityCard);
        $customer->addCustomer($conn);
        $successMsg = "This customer has been added successfully in our bank<br>Customer password: $password";
        $fullName = $userName = $identityCard = "";
    }
}

$title = "Add Customers";

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Add Customers</h2>
</div>
<?php
if (!empty($successMsg)) {
    echo MessageHandler::successMsg($successMsg);
}
if (!empty($errorMsg)) {
    echo MessageHandler::errorMsgArray($errorMsg);
}
?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off" id="addCustomerFrom">
    <div id="addCustomerErrors" class='alert alert-danger text-center'>
        <p class='lead' id='errFullName'><i class='fa fa-exclamation-circle mr-2'></i>Full name is invalid</p>
        <p class='lead' id='errUserName'><i class='fa fa-exclamation-circle mr-2'></i>User name is invalid at least 3 characters</p>
        <p class='lead' id='errIdentityCard'><i class='fa fa-exclamation-circle mr-2'></i>Identity card is invalid only 9 numbers</p>
    </div>
    <div class="form-group">
        <input type="text" name="fullName" id="fullName" class="form-control" value="<?php echo $fullName ?>" placeholder="Full Name" required>
    </div>
    <div class="form-group">
        <input type="text" name="userName" id="userName" class="form-control" value="<?php echo $userName ?>" placeholder="User Name" required>
    </div>
    <div class="form-group">
        <input type="text" name="identityCard" id="identityCard" class="form-control" value="<?php echo $identityCard ?>" placeholder="Identity Card" required>
    </div>
    <div class="form-group">
        <input type="submit" name="addCustomer" id="addCustomer" class="btn btn-success w-100" value="Add Customer">
    </div>
</form>
<?php require_once("layout/footer.php"); ?>
