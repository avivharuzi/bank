<?php

class Account implements iAccount {
    public $Id;
    public $AccountNumber;
    public $Type;
    public $Balance;
    public $Date;
    public $CustomerId;
    
    public function __construct() {
        if (func_num_args() > 0) {
            $this->Id            = func_get_arg(0);
            $this->AccountNumber = func_get_arg(1);
            $this->Type          = func_get_arg(2);
            $this->Balance       = func_get_arg(3);
            $this->Date          = func_get_arg(4);
            $this->CustomerId    = func_get_arg(5);
        }
    }

    public function addAccount($conn) {
        $sql = "INSERT INTO account (AccountNumber, Type, Balance, Date, CustomerId)
        VALUES ('$this->AccountNumber', '$this->Type', '$this->Balance', '$this->Date', '$this->CustomerId')";
        $result = $conn->connectData($sql);
        LoggerMessages::catchError($result, "addAccount function success", "problem with adding account to database"); // Logger
        return true;
    }

    public function depositAccount($conn, $amount, $date) {
        $this->Balance += $amount;
        $sql = "UPDATE account SET Balance = '$this->Balance' WHERE Id = $this->Id";
        $conn->connectData($sql);
        $sql = "UPDATE bank SET Balance = balance+$amount WHERE Id = 1";
        $conn->connectData($sql);
        $sql = "INSERT INTO transactions (Action, Money, Balance, Date, AccountId)
        VALUES ('deposit', $amount, $this->Balance, '$date', '$this->Id')";
        $result = $conn->connectData($sql);
        LoggerMessages::catchError($result, "depositAccount function success", "problem with deposit action to database"); // Logger
        return true;
    }

    public function withdrawalAccount($conn, $amount, $date) {
        if (strtolower($this->Type) == "private") {
            if ($amount < 2000) {
                $score = $this->Balance - $amount;
                if ($score > 0) {
                    $sql = "UPDATE account SET Balance = '$score' WHERE Id = $this->Id";
                    $conn->connectData($sql);
                    $sql = "UPDATE bank SET Balance = balance-$amount WHERE Id = 1";
                    $conn->connectData($sql);
                    $sql = "INSERT INTO transactions (Action, Money, Balance, Date, AccountId)
                    VALUES ('withdrawal', $amount, $score, '$date', '$this->Id')";
                    $result = $conn->connectData($sql);
                    LoggerMessages::catchError($result, "withdrawalAccount function success", "problem with withdrawal action to database"); // Logger
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else if (strtolower($this->Type) == "business") {
            $score = $this->Balance - $amount;
            if ($score > -20000) {
                $sql = "UPDATE account SET Balance = '$score' WHERE Id = $this->Id";
                $conn->connectData($sql);
                $sql = "UPDATE bank SET Balance = balance-$amount WHERE Id = 1";
                $conn->connectData($sql);
                $sql = "INSERT INTO transactions (Action, Money, Balance, Date, AccountId)
                VALUES ('withdrawal', $amount, $score, '$date', '$this->Id')";
                $result = $conn->connectData($sql);
                LoggerMessages::catchError($result, "withdrawalAccount function success", "problem with withdrawal action to database"); // Logger
                return true;
            } else {
                return false;
            }
        }
    }

    public function deleteAccount($conn) {
        if ($this->Balance >= 0) {
            $sql = "UPDATE bank SET Balance = balance-$this->Balance WHERE Id = 1";
            $conn->connectData($sql);
            $sql = "DELETE FROM transactions WHERE AccountId = $this->Id";
            $conn->connectData($sql);
            $sql = "DELETE FROM account WHERE Id = $this->Id";
            $result = $conn->connectData($sql);
            LoggerMessages::catchError($result, "deleteAccount function success", "problem with delete account to database"); // Logger
            return true;
        } else {
            return false;
        }
    }
}

?>
