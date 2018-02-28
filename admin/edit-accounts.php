<?php

require_once("auth/config.php");

$title = "Edit Accounts";

if (isset($_POST["deleteAccount"])) {
    $accountId = $_POST["deleteAccount"];

    if ((AccountHandler::deleteAccountAction($conn, $accountId)) === true) {
        $successMsg = "This account deleted successfully";
    } else {
        $errorMsg = "This account cannot be deleted because it is in debt";
    }
}

if (isset($_POST["withdrawal"])) {
    $accountId = $_POST["withdrawal"];
    if (($resultMsg = AccountHandler::withdrawalAction($conn, $_POST["amountWithdrawal$accountId"], $stringDate, $accountId)) === true) {
        $successMsg = "You withdrawal $" . $_POST["amountWithdrawal$accountId"] . " from your bank account";
    } else {
        $errorMsg = $resultMsg;
    }
}

if (isset($_POST["deposit"])) {
    $accountId = $_POST["deposit"];
    if (($resultMsg = AccountHandler::depositAction($conn, $_POST["amountDeposit$accountId"], $stringDate, $accountId)) === true) {
        $successMsg = "You added $" . $_POST["amountDeposit$accountId"] . " to your bank account";
    } else {
        $errorMsg = $resultMsg;
    }
}

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Edit Accounts</h2>
</div>
<?php
if (!empty($successMsg)) {
    echo MessageHandler::successMsg($successMsg);
}
if (!empty($errorMsg)) {
    echo MessageHandler::errorMsg($errorMsg);
}
if (($table = AccountHandler::tableData($conn)) === false) {
    $warningMsg = "There are no accounts in the bank";
} else {
    echo $table;
}
if (!empty($warningMsg)) {
    echo MessageHandler::warningMsg($warningMsg);
}
?>
<?php require_once("layout/footer.php"); ?>
