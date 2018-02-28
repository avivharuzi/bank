"use strict";

$(document).ready(function() {
    $(".icon-edit").on("click", function() {
        $(this).parent().next().show();
    });
});

$(document).ready(function() {
    $(".cancel-edit").on("click", function() {
        $(this).parent().hide();
    });
});

$(document).ready(function() {
    $("#print").on("click", function() {
        $("#transactions").printThis();
    });
});

$(document).ready(function() {
    $(".icon-plus").on("click", function() {
        $(this).parent().next().toggle();
    });
});

$(document).ready(function() {
    $(".icon-minus").on("click", function() {
        $(this).parent().next().next().toggle();
    });
});

$(document).ready(function() {
    $("#addCustomerFrom").on("submit", function() {
        let fullName, userName, identityCard;
        fullName     = $("#fullName").val();
        userName     = $("#userName").val();
        identityCard = $("#identityCard").val();
    
        let regFullName, regUserName, regIdentityCard;
        regFullName     = /^[a-zA-Z ]*$/;
        regUserName     = /^[A-Za-z0-9_]{3,20}$/;
        regIdentityCard = /^[0-9]{9}$/;
        
        const div = $("#addCustomerErrors");

        let counter = 0;
        
        if (checkInputs(fullName, regFullName, div, $("#errFullName")) === false) {
            counter += 1;
        }

        if (checkInputs(userName, regUserName, div, $("#errUserName")) === false) {
            counter += 1;
        }
    
        if (checkInputs(identityCard, regIdentityCard, div, $("#errIdentityCard")) === false) {
            counter += 1;
        }
        
        if (counter !== 0) {
            return false;
        }
    });
});

function checkInputs(value, reg, div, error) {
    if (reg.test(value) === false) {
        div.show();
        error.show();
        return false;
    } else {
        error.hide();
        return true;
    }
}
