<?php

session_start();

// Auth
require_once("auth/restrict.php");
require_once("../connection/db.php"); 

// Interfaces
require_once("../interfaces/i-account.php");
require_once("../interfaces/i-customer.php");

// Models
require_once("../models/bank.php");
require_once("../models/customer.php");
require_once("../models/account.php");

// Handlers
require_once("../handlers/message-handler.php");
require_once("../handlers/validation-handler.php");
require_once("../handlers/generate-handler.php");
require_once("../handlers/customer-handler.php");
require_once("../handlers/account-handler.php");
require_once("../handlers/bank-handler.php");

date_default_timezone_set("Israel");

$date = new DateTime("now");
$stringDate = date_format($date ,"Y-m-d H:i:s");

?>
