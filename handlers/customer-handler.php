<?php

class CustomerHandler {
    private function __construct() {
    }

    public static function checkUserName($conn, $userName) {
        $sql = "SELECT * FROM customer WHERE UserName = '$userName' LIMIT 1";
        if ($conn->getRows($sql) > 0) {
            return true;
        }
    }

    public static function checkIdentityCard($conn, $identityCard) {
        $sql = "SELECT * FROM customer WHERE IdentityCard = '$identityCard' LIMIT 1";
        if ($conn->getRows($sql) > 0) {
            return true;
        }
    }

    public static function getNumberOfCustomers($conn) {
        $sql = "SELECT count(*) as CustomerSum FROM customer";
        $result = $conn->getSingleData($sql);
        $CustomerSum = $result->CustomerSum;
        return $CustomerSum;        
    }

    public static function deleteCustomer($conn, $customerId) {
        $sql = "SELECT * FROM account WHERE CustomerId = $customerId LIMIT 1";
        $result = $conn->getSingleData($sql);
        if ($result) {
            return false;
        } else {
            $sql = "DELETE FROM customer WHERE id = $customerId";
            $conn->connectData($sql);
            return true;
        }
    }
    
    public static function headerTable() {
        return
        "<div class='col-lg-12'>
        <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST' autocomplete='off'>
        <table class='table table-hovered table-striped table-hover table-responsive'>
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>User Name</th>
                    <th>Password</th>
                    <th>Identity Card</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        <tbody>";
    }

    public static function bottomTable() {
        return "</tbody></table></form></div>";
    }

    public static function changeCustomer($conn, $customerId) {
        $regFullName     = "/^[a-zA-Z ]*$/";
        $regUserName     = "/^[A-Za-z0-9_]{3,20}$/";
        $regIdentityCard = "/^[0-9]{9}$/";
        $regPassword     = "/^[A-Za-z0-9]{9}$/";

        if (!ValidationHandler::validateInputs($_POST["fullName$customerId"], $regFullName)) {
            $errorMsg[] = "This full name is invalid";
        } else {
            $fullName = ValidationHandler::testInput(strtolower($_POST["fullName$customerId"]));
        }
    
        if (!ValidationHandler::validateInputs($_POST["userName$customerId"], $regUserName)) {
            $errorMsg[] = "This user name is invalid";
        } else {
            $userName = ValidationHandler::testInput(strtolower($_POST["userName$customerId"]));
            if (self::checkUserName($conn, $userName)) {
                $errorMsg[] = "This user name is already in used";
            }
        }
    
        if (!ValidationHandler::validateInputs($_POST["identityCard$customerId"], $regIdentityCard)) {
            $errorMsg[] = "This identity card is invalid";
        } else {
            $identityCard = ValidationHandler::testInput(strtolower($_POST["identityCard$customerId"]));
            if (self::checkIdentityCard($conn, $identityCard)) {
                $errorMsg[] = "This identity card is already in used";
            }
        }

        if (!ValidationHandler::validateInputs($_POST["password$customerId"], $regPassword)) {
            $errorMsg[] = "This password is invalid";
        } else {
            $password = ValidationHandler::testInput($_POST["password$customerId"]);
        }

        if (!isset($errorMsg)) {
            $customer = new Customer($customerId, $fullName, $userName, $password, $identityCard);
            $customer->updateCustomer($conn);
            return true;
        } else {
            return $errorMsg;
        }
    }
}

?>
