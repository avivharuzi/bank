<?php

require_once("auth/config.php");

$title = "Edit Accounts";

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Edit Accounts</h2>
</div>
<?php

echo AccountHandler::depositFromAdmin($conn, $stringDate);
echo AccountHandler::withdrawalFromAdmin($conn, $stringDate);
echo AccountHandler::deleteAccount($conn);

echo AccountHandler::tableData($conn);

?>
<?php require_once("layout/footer.php"); ?>
