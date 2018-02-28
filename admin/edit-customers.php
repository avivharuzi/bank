<?php

require_once("auth/config.php");

if (isset($_POST["deleteCustomer"])) {
    if (CustomerHandler::deleteCustomer($conn, $_POST["deleteCustomer"])) {
        $successMsgDelete = "This customer deleted successfully";
    } else {
        $errorMsgDelete = "This customer have a bank account and cannot be deleted";
    }
}

if (isset($_POST["saveCustomer"])) {
    if (($errorMsgSave = CustomerHandler::changeCustomer($conn, $_POST["saveCustomer"])) === true) {
        $successMsgSave = "This customer changed successfully";
    }
}

$sql = "SELECT * FROM customer";
$result = $conn->getFullData($sql, "Customer");

$table = "";

if ($result) {
    $table .= CustomerHandler::headerTable();
    foreach ($result as $value) {
        $table .= $value->tableData();
    }
    $table .= CustomerHandler::bottomTable();
} else {
    $warningMsg = "There are no customers in the bank yet";
}

$title = "Edit Customers";

?>

<?php require_once("layout/header.php"); ?>
    <div class="jumbotron bg-info text-light mt-5 p-3">
        <h2>Edit Customers</h2>
    </div>
<?php
if (!empty($successMsgDelete)) {
    echo MessageHandler::successMsg($successMsgDelete);
}
if (!empty($errorMsgDelete)) {
    echo MessageHandler::errorMsg($errorMsgDelete);
}
if (!empty($successMsgSave)) {
    echo MessageHandler::successMsg($successMsgSave);
}
if (!empty($errorMsgSave) && $errorMsgSave !== true) {
    echo MessageHandler::errorMsgArray($errorMsgSave);
}
if (!empty($warningMsg)) {
    echo MessageHandler::warningMsg($warningMsg);
}
if (!empty($table)) {
    echo $table;
}
?>
<?php require_once("layout/footer.php"); ?>
