<?php

require_once("auth/config.php");

$title = "Search";

?>

<?php require_once("layout/header.php"); ?>
<div class="jumbotron bg-info text-light mt-5 p-3">
    <h2>Search</h2>
</div>
<div class="col-lg-12 mb-5">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="GET" autocomplete="off">
        <div class="form-row">
            <div class="col-lg-9 col-md-12">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
                    <input type="search" class="form-control" name="identityCard" id="identityCard" placeholder="Identity Card..." required autofocus>
                </div>
            </div>
            <div class="col-lg-3 col-md-12">
                <input type="submit" class="btn btn-dark w-100" name="search" value="Search">
            </div>
        </div>
    </form>
</div>
<?php

echo AccountHandler::depositFromAdmin($conn, $stringDate);
echo AccountHandler::withdrawalFromAdmin($conn, $stringDate);
echo AccountHandler::deleteAccount($conn);

echo AccountHandler::searchAccount($conn);

?>
<?php require_once("layout/footer.php"); ?>
