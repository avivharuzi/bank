<?php

require_once("auth/config.php");

$title = "Details";

require_once("layout/header.php");

echo BankHandler::getBankInformation($conn);

require_once("layout/footer.php");

?>
