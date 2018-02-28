<?php

if (!(basename($_SERVER["SCRIPT_FILENAME"], ".php") === "login")) {
    isLoggedIn();
    accountId();
}

// Check if the user is logged in already
function isLoggedIn() {
    if (!isset($_SESSION["accountIsLoggedIn"]) && !isset($_SESSION["accountId"])) {
        header("Location: login.php");
        exit();
    }   
}

// If user logged in take the id from him
function accountId() {
    if (isset($_SESSION["accountId"])) {
        global $accountId;
        $accountId = $_SESSION["accountId"];
    }
}

?>
