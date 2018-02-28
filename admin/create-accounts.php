<?php

require_once("auth/config.php");

if (isset($_POST["addAccount"])) {
    $counter = 0;

    if (!empty($_POST["customerId"])) {
        if ((AccountHandler::checkAccount($conn, $_POST["customerId"])) === false) {
            $customerId = $_POST["customerId"];
        } else {
            $counter += 1;
            $errorMsg = "This customer has already account in the bank";
        }
    } else {
        $counter += 1;
    }

    if (!empty($_POST["typeAccount"])) {
        if ($_POST["typeAccount"] === "private" || $_POST["typeAccount"] === "business") {
            $typeAccount = $_POST["typeAccount"];
        } else {
            $counter += 1;
        }
    } else {
        $counter += 1;
    }

    if ($counter === 0) {
        $accountNumber = GenerateHandler::generateNumbers($conn);
        $account = new Account(null, $accountNumber, $typeAccount, 0, $stringDate, $customerId);
        $account->addAccount($conn);
        $successMsg = "Account has been created successfully in our bank<br>Customer bank account number: $accountNumber";
    }
}

$sql = "SELECT * FROM customer";
$result = $conn->getFullData($sql);

$options = "";

if ($result) {
    foreach ($result as $value) {
        $options .= "<option value='$value->Id'>" . ucwords($value->FullName) . "</option>";
    }
} else {
    $warningMsg = "There are no customers in the bank yet";
}

$title = "Create Accounts";

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Create Accounts</h2>
</div>
<?php
if (!empty($successMsg)) {
    echo MessageHandler::successMsg($successMsg);
}
if (!empty($errorMsg)) {
    echo MessageHandler::errorMsg($errorMsg);
}
if (!empty($warningMsg)) {
    echo MessageHandler::warningMsg($warningMsg);
}
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
<?php } ?>
<?php require_once("layout/footer.php"); ?>
