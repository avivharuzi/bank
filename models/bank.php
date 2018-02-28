<?php

class Bank {
    private $Id;
    private $Name;
    private $City;
    private $Street;
    private $Balance;

    public function __construct() {
    }

    public function getId() {
        return $this->Id;
    }

    public function getName() {
        return $this->Name;
    }

    public function getCity() {
        return $this->City;
    }

    public function getStreet() {
        return $this->Street;
    }

    public function getBalance() {
        return $this->Balance;
    }
}

?>
