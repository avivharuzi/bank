<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="ATM system to deposit money and withdrawal money">
        <meta name="keywords" content="ATM, deposit, withdrawal, money">
        <meta name="author" content="Aviv Haruzi">
        <title><?php if (isset($title)) { echo $title; } ?></title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/libs/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css">        
        <link rel="shortcut icon" type="image/x-icon" href="assets/images/icons/money.ico">
        <link rel="icon" type="image/png" href="assets/images/icons/money.png">
    </head>
    <body id="main-atm">
        <?php if (isset($_SESSION["accountIsLoggedIn"]) === true) { ?>
        <div class="container">
            <div class="text-center mt-5">
                <img src="assets/images/main/atm.svg" height="200px" width="auto">
            </div>
            <div class="text-center mt-5">
                <a href="logout.php" class="btn btn-danger w-25">Exit</a>
            </div>
        </div>
        <?php } ?>
        <div class="container">
