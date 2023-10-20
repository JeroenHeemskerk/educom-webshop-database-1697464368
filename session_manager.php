<?php

    function getLoggedInUserName() {
        return $_SESSION['user'];
    }
    
    function isUserLoggedIn() {
        return isset($_SESSION['user']);
    }
    
    function loginUser($name) {        
        $_SESSION['user'] = $name;
    }
    
    function logoutUser() {        
        unset($_SESSION['user']);
    }
    
    function createShoppingCart() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    function addItemToShoppingCart() {

        $item = getPostVar('item');

        if ($item != ""){ 

            if (!isset($_SESSION['cart'][$item])){
                $_SESSION['cart'][$item] = 1;
            } else {
                $_SESSION['cart'][$item] += 1;
            }
        }
    }
?>