<?php

class ValidationHandler {
    private function __construct() {
    }
    
    public static function validateInputs($value, $reg) {
        if (!empty($value)) {
            if (!preg_match($reg, $value)) {
                return false;
            } else {
                return true;
            }
        } else {
            return false;
        }
    }
    
    public static function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}

?>
