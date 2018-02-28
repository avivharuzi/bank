<?php

class MessageHandler {
    private function __construct() {
    }

    public static function errorMsg($msg) {
        return
        "<div class='alert alert-danger text-center'>
            <p class='lead'><i class='fa fa-exclamation-circle mr-2'></i>$msg</p>
        </div>";
    }

    public static function errorMsgArray($arr) {
        $msg = "<div class='alert alert-danger text-center'>";
        foreach ($arr as $value) {
            $msg .= "<p class='lead'><i class='fa fa-exclamation-circle mr-2'></i>$value</p>";
        }
        $msg .= "</div>";
        return $msg;
    }

    public static function successMsg($msg) {
        return
        "<div class='alert alert-success text-center'>
            <p class='lead'><i class='fa fa-check-circle-o mr-2'></i>$msg</p>
        </div>";
    }

    public static function successMsgArray($arr) {
        $msg = "<div class='alert alert-success text-center'>";
        foreach ($arr as $value) {
            $msg .= "<p class='lead'><i class='fa fa-check-circle-o mr-2'></i>$value</p>";
        }
        $msg .= "</div>";
        return $msg;
    }

    public static function warningMsg($msg) {
        return
        "<div class='alert alert-warning text-center'>
            <p class='lead'><span class='mr-2'><i class='fa fa-exclamation-circle'></i></span>$msg</p>
        </div>";
    }

    public static function warningMsgArray($arr) {
        $msg = "<div class='alert alert-warning text-center'>";
        foreach ($arr as $value) {
            $msg .= "<p class='lead'><span class='mr-2'><i class='fa fa-exclamation-circle'></i></span>$value</p>";
        }
        $msg .= "</div>";
        return $msg;
    }

    public static function bigErrorMsg($msg) {
        return
        "<div class='jumbotron p-3 text-center text-light bg-danger mt-5'>
            <h3><i class='fa fa-exclamation-circle mr-2'></i>$msg</h3>
        </div>";
    }

    public static function bigSuccessMsg($msg) {
        return
        "<div class='jumbotron p-3 text-center text-light bg-success mt-5'>
            <h3><i class='fa fa-check-circle-o mr-2'></i>$msg</h3>
        </div>";
    }
}

?>
