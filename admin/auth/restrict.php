<?php

if (!(basename($_SERVER["SCRIPT_FILENAME"], ".php") === "login")) {
    isLoggedIn();
}

// Check if the user is logged in already
function isLoggedIn() {
    if (!isset($_SESSION["adminIsLoggedIn"])) {
        header("Location: login.php");
        exit();
    }   
}

?>
