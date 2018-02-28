<?php

interface iAccount {
    public function addAccount($conn);

    public function depositAccount($conn, $amount, $date);

    public function withdrawalAccount($conn, $amount, $date);

    public function deleteAccount($conn);
}

?>