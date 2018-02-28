<?php

class GenerateHandler {
    private function __construct() {
    }

    public static function generatePassword($length = 9, $strength = false) {
        $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    
        if ($strength === true) {
            $string .= "@#$%";
        }
    
        $password = "";
    
        for ($i = 0; $i < $length; $i++) {
            $password .= $string[(rand() % strlen($string))];
        }
        return $password;
    }

    public static function generateNumbers($conn, $length = 6) {
        $numbers = "0123456789";

        $result = "";
    
        for ($i = 0; $i < $length; $i++) {
            $result .= $numbers[(rand() % strlen($numbers))];
        }

        if (self::checkNumbers($conn, $result)) {
            return $result;
        }
    }

    public static function checkNumbers($conn, $numbers) {
        $sql = "SELECT * FROM account WHERE AccountNumber = $numbers LIMIT 1";
        $result = $conn->getSingleData($sql);
        if ($result) {
            self::generateNumbers($conn);
        } else {
            return true;
        }
    }
}

?>
