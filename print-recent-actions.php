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
    if ($transactions = AccountHandler::getTransactions($conn, $accountId)) {
        echo $transactions;
    } else {
        echo
        "<div class='mt-5'>" .
            MessageHandler::warningMsg("You have not done any transactions yet") . 
        "</div>";
    }
    ?>
</div>
<?php require_once("layout/footer.php"); ?>
