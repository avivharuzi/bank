<?php

class Customer implements iCustomer {
    public $Id;
    public $FullName;
    public $UserName;
    public $Password;
    public $IdentityCard;

    public function __construct() {
        if (func_num_args() > 0) {
            $this->Id           = func_get_arg(0);
            $this->FullName     = func_get_arg(1);
            $this->UserName     = func_get_arg(2);
            $this->Password     = func_get_arg(3);
            $this->IdentityCard = func_get_arg(4);
        }
    }

    public function addCustomer($conn) {
        $sql = "INSERT INTO customer (FullName, UserName, Password, IdentityCard)
        VALUES ('$this->FullName', '$this->UserName', '$this->Password', '$this->IdentityCard')";
        $result = $conn->connectData($sql);
        return true;
    }

    public function updateCustomer($conn) {
        $sql = "UPDATE customer SET FullName = '$this->FullName', UserName = '$this->UserName', Password = '$this->Password', IdentityCard = '$this->IdentityCard' WHERE Id = $this->Id";
        $result = $conn->connectData($sql);
        return true;
    }

    public function tableData() {
        return
        "<tr>
            <td>" . ucwords($this->FullName) . "</td>
            <td>" . ucwords($this->UserName) . "</td>
            <td>" . $this->Password . "</td>
            <td>" . $this->IdentityCard . "</td>
            <td><button class='btn btn-danger text-center' name='deleteCustomer' value='$this->Id'><i class='fa fa-trash'></i></button></td>
            <td class='icon-edit'><img src='../assets/images/icons/edit.png'></td>
        </tr>
        <tr class='tr-edit'>
            <td><input type='text' class='form-control' name='fullName$this->Id' placeholder='Full Name' autofocus></td>
            <td><input type='text' class='form-control' name='userName$this->Id' placeholder='User Name'></td>
            <td><input type='text' class='form-control' name='password$this->Id' placeholder='Password'></td>
            <td><input type='text' class='form-control' name='identityCard$this->Id' placeholder='Identity Card'></td>
            <td class='cancel-edit'><img src='../assets/images/icons/cancel.png'></td>
            <td><input type='image' src='../assets/images/icons/save.png' name='saveCustomer' value='$this->Id'></td>
        </tr>
        <div class='d-none'><input type='hidden' name='existIdentityCard$this->Id' value='$this->IdentityCard'></div>
        ";
    }

    public function setSession($accountId) {
        $_SESSION["accountIsLoggedIn"] = true;
        $_SESSION["accountId"]         = $accountId;
        header("Location: index.php");
        exit();
    }
}

?>
