<?php

require_once("auth/config.php");

$title = "Print Recent Actions";

?>

<?php require_once("layout/header.php"); ?>
<div class="text-center mt-5">
    <a href="index.php" class="btn btn-primary w-25">Back</a>
</div>
<div class="row justify-content-center">
    <?php
    echo AccountHandler::getTransactions($conn, $accountId);
    ?>
</div>
<?php require_once("layout/footer.php"); ?>
