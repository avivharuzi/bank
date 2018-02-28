<?php

require_once("auth/config.php");

$title = "Edit Customers";

?>

<?php require_once("layout/header.php"); ?>
    <div class="jumbotron bg-info text-light mt-5 p-3">
        <h2>Edit Customers</h2>
    </div>
<?php

echo CustomerHandler::deleteCustomerAction($conn);
echo CustomerHandler::saveCustomerAction($conn);
echo CustomerHandler::tableData($conn);
?>
<?php require_once("layout/footer.php"); ?>
