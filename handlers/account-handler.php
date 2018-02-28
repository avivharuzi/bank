<?php

class AccountHandler {
    private function __construct() {
    }

    public static function checkAccount($conn, $customerId) {
        $sql = "SELECT * FROM account WHERE CustomerId = $customerId LIMIT 1";
        $result = $conn->getSingleData($sql);

        if ($result) {
            return $result->Id;
        } else {
            return false;
        }
    }

    public static function getAccountInstance($conn, $accountId) {
        $sql = "SELECT * FROM account WHERE Id = $accountId";
        $result = $conn->getSingleData($sql, "Account");

        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public static function getNumberOfAccounts($conn) {
        $sql = "SELECT count(*) as AccountSum FROM account";
        $result = $conn->getSingleData($sql);
        $AccountSum = $result->AccountSum;
        return $AccountSum;        
    }

    public static function withdrawalAction($conn, $amount, $stringDate, $accountId) {
        if (ValidationHandler::validateInputs($amount, "/^[0-9]*$/")) {
            $account = self::getAccountInstance($conn, $accountId);
            if ($account->withdrawalAccount($conn, $amount, $stringDate)) {
                return true;
            } else {
                 return "You cant withdrawal this amount of money";
            }
        } else {
            return "You can only insert positive numbers";
        }
    }

    public static function depositAction($conn, $amount, $stringDate, $accountId) {
        if (ValidationHandler::validateInputs($amount, "/^[0-9]*$/")) {
            $account = self::getAccountInstance($conn, $accountId);
            if ($account->depositAccount($conn, $amount, $stringDate)) {
                return true;
            }
        } else {
            return "You can only insert positive numbers";
        }
    }

    public static function tableData($conn, $search = false, $customerId = null) {
        $sql =
        "SELECT
        account.Id AS Id, account.AccountNumber AS AccountNumber, account.Type AS Type,
        account.Date AS Date, account.Balance AS Balance, customer.FullName AS FullName, customer.UserName AS UserName,
        customer.Password AS Password, customer.IdentityCard AS IdentityCard
        FROM account
        JOIN customer ON account.CustomerId = customer.Id";

        if ($search === true && $customerId !== null) {
            $sql .= " WHERE account.CustomerId = $customerId";
        }

        $result = $conn->getFullData($sql);

        if ($result) {
            $table =
            "<div class='col-lg-12'>
            <form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST' autocomplete='off'>
            <table class='table table-hovered table-striped table-hover table-responsive'>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Identity Card</th>
                        <th>Account Number</th>
                        <th>Type</th>
                        <th>Balance</th>
                        <th>Date Created</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>";

            foreach ($result as $value) {
                $table .=
                "<tr>
                    <td>" . ucwords($value->FullName) . "</td>
                    <td>$value->IdentityCard</td>
                    <td>$value->AccountNumber</td>
                    <td>" . ucwords($value->Type) . "</td>
                    <td>$" . $value->Balance . "</td>
                    <td>" . ucwords($value->Date) . "</td>
                    <td class='icon-plus'><div class='btn btn-success text-center'><i class='fa fa-plus'></i></div></td>
                    <td class='icon-minus'><div class='btn btn-primary text-center'><i class='fa fa-minus'></i></div></td>
                    <td class='icon-info'><div class='btn btn-warning text-light text-center' data-toggle='modal' data-target='#info$value->Id'><i class='fa fa-info'></i></div></td>
                    <td><button class='btn btn-danger text-center' name='deleteAccount' value='$value->Id'><i class='fa fa-trash'></i></button></td>
                </tr>
                <tr class='tr-plus'>
                    <td colspan='5'><input type='number' name='amountDeposit$value->Id' id='amountDeposit$value->Id' class='form-control' min='0' step='50' placeholder='Amount'></td>
                    <td colspan='5'><button name='deposit' id='deposit' value='$value->Id' class='btn btn-dark w-100'>Deposit</button></td>
                </tr>
                <tr class='tr-minus'>
                    <td colspan='5'><input type='number' name='amountWithdrawal$value->Id' id='amountWithdrawal$value->Id' class='form-control' min='0' step='50' placeholder='Amount'></td>
                    <td colspan='5'><button name='withdrawal' id='withdrawal' value='$value->Id' class='btn btn-dark w-100'>Withdrawal</button></td>
                </tr>
                <div class='modal fade' id='info$value->Id' role='dialog' aria-hidden='true'>
                    <div class='modal-dialog modal-lg' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title'>Transactions</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                            </div>
                            <div class='modal-body'>" .
                            self::transactionsTable($conn, $value->Id) .
                            "</div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>";
            }

            $table .= "</tbody></table></form></div>";

            return $table;
        } else {
            return MessageHandler::warningMsg("There are no accounts in the bank");
        }
    }

    public static function transactionsTable($conn, $accountId) {
        $sql = "SELECT * FROM transactions WHERE AccountId = $accountId";
        $result = $conn->getFullData($sql);

        $transactions = "";

        if ($result) {
            foreach ($result as $value) {
                $transactions .= "<p class='lead'>$value->Date - " . ucwords($value->Action) . " $" . "$value->Money - In Balance $" . "$value->Balance</p>";
            }

            return $transactions;
        } else {
            return MessageHandler::warningMsg("This account have not done any transactions yet") ;
        }
    }

    public static function getTransactions($conn, $accountId) {
        $sql = "SELECT * FROM transactions WHERE AccountId = $accountId";
        $result = $conn->getFullData($sql);

        if ($result) {
            $transactions = 
            "<div class='text-center bg-light p-5 mt-5 mb-5'>
                <div id='transactions'>
                    <div class='jumbotron bg-dark text-light p-2'>
                        <h4>Transactions</h4>
                    </div>";
            
            foreach ($result as $value) {
                $transactions .= "<p class='lead'>$value->Date - " . ucwords($value->Action) . " $" . "$value->Money - In Balance $" . "$value->Balance</p>";
            }

            $transactions .=
                "</div>
                <button class='btn btn-info w-100 mt-3' id='print'>Print</button>
            </div>";

            return $transactions;
        } else {
            return
            "<div class='mt-5'>" .
                MessageHandler::warningMsg("You have not done any transactions yet") . 
            "</div>";
        }
    }

    public static function deleteAccountAction($conn, $accountId) {
        $sql = "SELECT * FROM account WHERE Id = $accountId LIMIT 1";
        $result = $conn->getSingleData($sql, "Account");

        if ($result) {
            if ($result->deleteAccount($conn)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function loginCustomer($conn) {
        if (isset($_POST["login"])) {
            $identityCard = $conn->escape($_POST["identityCard"]);
            $password     = $conn->escape($_POST["password"]);
            $sql = "SELECT * FROM customer WHERE IdentityCard = '$identityCard' LIMIT 1";
            $result = $conn->getSingleData($sql, "Customer");
        
            if ($result && $result->Password === $password) {
                if (($accountId = self::checkAccount($conn, $result->Id)) !== false) {
                        $result->setSession($accountId);
                } else {
                    return MessageHandler::errorMsg("You are a bank customer but you still dont have an account");
                }
            } else {
                return MessageHandler::errorMsg("You have entered an invalid identity card or password");
            }
        }
    }

    public static function loginAdmin($conn) {
        if (isset($_POST["login"])) {
            $userName = $conn->escape(strtolower($_POST["userName"]));
            $password = $conn->escape($_POST["password"]);
            $sql = "SELECT * FROM admin WHERE UserName = '$userName' LIMIT 1";
            $result = $conn->getSingleData($sql);
            if ($result && $password === $result->Password) {
                $_SESSION["adminIsLoggedIn"] = true;
                header("Location: index.php");
            } else {
                return MessageHandler::errorMsg("You have entered an invalid username or password");
            }
        }
    }

    public static function deposit($conn, $stringDate, $accountId) {
        if (isset($_POST["deposit"])) {
            if (($resultMsg = self::depositAction($conn, $_POST["amount"], $stringDate, $accountId)) === true) {
                return MessageHandler::successMsg("You added $" . $_POST["amount"] . " to your bank account");
            } else {
                return MessageHandler::errorMsg($resultMsg);
            }
        }
    }

    public static function withdrawal($conn, $stringDate, $accountId) {
        if (isset($_POST["withdrawal"])) {
            if (($resultMsg = self::withdrawalAction($conn, $_POST["amount"], $stringDate, $accountId)) === true) {
                return MessageHandler::successMsg("You withdrawal $" . $_POST["amount"] . " from your bank account");
            } else {
                return MessageHandler::errorMsg($resultMsg);
            }
        }
    }

    public static function depositFromAdmin($conn, $stringDate) {
        if (isset($_POST["deposit"])) {
            $accountId = $_POST["deposit"];
            if (($resultMsg = self::depositAction($conn, $_POST["amountDeposit$accountId"], $stringDate, $accountId)) === true) {
                return MessageHandler::successMsg("You added $" . $_POST["amountDeposit$accountId"] . " to your bank account");
            } else {
                return MessageHandler::errorMsg($resultMsg);
            }
        }
    }

    public static function withdrawalFromAdmin($conn, $stringDate) {
        if (isset($_POST["withdrawal"])) {
            $accountId = $_POST["withdrawal"];
            if (($resultMsg = self::withdrawalAction($conn, $_POST["amountWithdrawal$accountId"], $stringDate, $accountId)) === true) {
                return MessageHandler::successMsg("You withdrawal $" . $_POST["amountWithdrawal$accountId"] . " from your bank account");
            } else {
                return MessageHandler::errorMsg($resultMsg);
            }
        }
    }

    public static function searchAccount($conn) {
        if (isset($_GET["search"])) {
            $identityCard = $_GET["identityCard"];
            $sql = "SELECT * FROM customer WHERE IdentityCard = '$identityCard' LIMIT 1";
            $result = $conn->getSingleData($sql);
        
            if ($result) {
                if (self::checkAccount($conn, $result->Id)) {
                    return MessageHandler::bigSuccessMsg("Match Found") . self::tableData($conn, true, $result->Id);
                } else {
                    return MessageHandler::bigErrorMsg("No Results");
                }
            } else {
                return MessageHandler::bigErrorMsg("No Results");
            }
        }
    }

    public static function deleteAccount($conn) {
        if (isset($_POST["deleteAccount"])) {
            $accountId = $_POST["deleteAccount"];
        
            if ((self::deleteAccountAction($conn, $accountId)) === true) {
                return MessageHandler::successMsg("This account deleted successfully");
            } else {
                return MessageHandler::errorMsg("This account cannot be deleted because it is in debt");
            }
        }
    }

    public static function addAccount($conn, $stringDate) {
        if (isset($_POST["addAccount"])) {
            $counter = 0;
        
            if (!empty($_POST["customerId"])) {
                if ((self::checkAccount($conn, $_POST["customerId"])) === false) {
                    $customerId = $_POST["customerId"];
                } else {
                    $counter += 1;
                    $errorMsg = "This customer has already account in the bank";
                }
            } else {
                $counter += 1;
            }
        
            if (!empty($_POST["typeAccount"])) {
                if ($_POST["typeAccount"] === "private" || $_POST["typeAccount"] === "business") {
                    $typeAccount = $_POST["typeAccount"];
                } else {
                    $counter += 1;
                }
            } else {
                $counter += 1;
            }
        
            if ($counter === 0) {
                $accountNumber = GenerateHandler::generateNumbers($conn);
                $account = new Account(null, $accountNumber, $typeAccount, 0, $stringDate, $customerId);
                $account->addAccount($conn);
                return MessageHandler::successMsg("Account has been created successfully in our bank<br>Customer bank account number: $accountNumber"); 
            }
        }
    }
}

?>
