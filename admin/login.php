<?php

require_once("auth/config.php");

if (isset($_POST["login"])) {
    $userName = $conn->escape(strtolower($_POST["userName"]));
    $password = $conn->escape($_POST["password"]);
    $sql = "SELECT * FROM admin WHERE UserName = '$userName' LIMIT 1";
    $result = $conn->getSingleData($sql);
    if ($result && $password === $result->Password) {
        $_SESSION["adminIsLoggedIn"] = true;
        header("Location: index.php");
    } else {
        $errorMsg = "You have entered an invalid username or password";
    }
}

$title = "Login";

?>

<?php require_once("layout/header.php"); ?>
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="jumbotron text-center mt-5 bg-dark text-white">
            <h1>Log In</h1>
        </div>
        <?php
        if (!empty($errorMsg)) {
            echo MessageHandler::errorMsg($errorMsg);
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
            <div class="form-group">
                <input type="text" class="form-control" name="userName" id="userName" placeholder="Username" autofocus required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary w-100" name="login" value="Submit">
            </div>
        </form>
    </div>
</div>
<?php require_once("layout/footer.php"); ?>
