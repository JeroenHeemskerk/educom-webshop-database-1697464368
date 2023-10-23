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

    function addProductToShoppingCart() {

        $product = getPostVar('product');

        //Indien product met de POST-request meegegeven is wordt deze toegevoegd aan cart
        if ($product != ""){ 

            if (!isset($_SESSION['cart'][$product])){
                $_SESSION['cart'][$product] = 1;
            } else {
                $_SESSION['cart'][$product] += 1;
            }
        }
    }
?>