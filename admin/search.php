<?php

require_once("auth/config.php");

if (isset($_GET["search"])) {
    $identityCard = $_GET["identityCard"];
    $sql = "SELECT * FROM customer WHERE IdentityCard = '$identityCard' LIMIT 1";
    $result = $conn->getSingleData($sql);

    if ($result) {
        if (AccountHandler::checkAccount($conn, $result->Id)) {
            $table = MessageHandler::bigSuccessMsg("Match Found") . AccountHandler::tableData($conn, true, $result->Id);
        } else {
            $bigErrorMsg = "No Results";
        }
    } else {
        $bigErrorMsg = "No Results";
    }
}

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

$title = "Search";

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Search</h2>
</div>
<div class="col-lg-12 mb-5">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" autocomplete="off">
        <div class="form-row">
            <div class="col-lg-9 col-md-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <input type="search" class="form-control" name="identityCard" id="identityCard" placeholder="Identity Card..." required autofocus>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <input type="submit" class="btn btn-dark w-100" name="search" value="Search">
            </div>
        </div>
    </form>
</div>
<?php
if (!empty($successMsg)) {
    echo MessageHandler::successMsg($successMsg);
}
if (!empty($errorMsg)) {
    echo MessageHandler::errorMsg($errorMsg);
}
if (!empty($bigErrorMsg)) {
    echo MessageHandler::bigErrorMsg($bigErrorMsg);
}
if (!empty($table)) {
    echo $table;
}
?>
<?php require_once("layout/footer.php"); ?>
