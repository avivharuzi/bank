<?php

session_start();

require_once("auth/restrict.php");
require_once("../connection/db.php"); 
require_once("../logger/logger.php");
require_once("../logger/logger-handler.php");
require_once("../interfaces/chain-interfaces.php");
require_once("../models/chain-models.php");
require_once("../handlers/chain-handlers.php");

date_default_timezone_set("Israel");

$date = new DateTime("now");
$stringDate = date_format($date ,"Y-m-d H:i:s");

?>
