<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin system management for bank accounts">
        <meta name="keywords" content="admin, system, management, bank, customers, accounts, edit">
        <meta name="author" content="Aviv Haruzi">
        <title><?php if (isset($title)) { echo $title; } ?></title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">       
        <link rel="stylesheet" type="text/css" href="../css/main/style.css">      
        <link rel="shortcut icon" type="image/x-icon" href="../images/icons/ancient.ico">
        <link rel="icon" type="image/png" href="../images/icons/ancient.png">
    </head>
    <body>
        <?php if (isset($_SESSION["adminIsLoggedIn"]) == true) { ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-expanded="false"><span class="navbar-toggler-icon"></span></button>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="add-customers.php">Add Customers</a></li>
                        <li class="nav-item"><a class="nav-link" href="edit-customers.php">Edit Customers</a></li>
                        <li class="nav-item"><a class="nav-link" href="create-accounts.php">Create Accounts</a></li>
                        <li class="nav-item"><a class="nav-link" href="edit-accounts.php">Edit Accounts</a></li>
                        <li class="nav-item"><a class="nav-link" href="search.php">Search</a></li>
                        <li class="nav-item"><a class="nav-link" href="details.php">Details</a></li>
                    </ul>
                    <ul class="navbar-nav my-2 my-lg-0">
                        <li class="nav-item float-right"><a class="nav-link" href="logout.php">Log out</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php } ?>
        <div class="container">
