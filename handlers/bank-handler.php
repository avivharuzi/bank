<?php

class BankHandler {
    private function __construct() {
    }

    public static function getBankInformation($conn) {
        $sql = "SELECT * FROM bank LIMIT 1";
        $result = $conn->getSingleData($sql, "Bank");

        return
        "<div class='col-lg-12'>
            <div class='card w-100 mt-5'>
                <div class='text-center p-3'>
                    <img src='../images/main/bank.png' alt='bank' width='256px;' height='256px;'>
                </div>
                <div class='card-body'>
                    <table class='table table-bordered table-hover text-center'>
                        <tbody>
                            <tr>
                                <td>Bank Name</td>
                                <td>{$result->getName()}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{$result->getCity()}</td>
                            </tr>
                            <tr>
                                <td>Street</td>
                                <td>{$result->getStreet()}</td>
                            </tr>
                            <tr>
                                <td>Balance</td>
                                <td>" . "$" . "{$result->getBalance()}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>";
    }
}

?>
