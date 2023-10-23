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
        unset($_SESSION['cart']);
    }
    
    function createShoppingCart() {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }
    }

    function addProductToShoppingCart($product_id, $quantity) {

        //Product wordt eerst geset indien deze nog niet aangemaakt was in de array
        if (!isset($_SESSION['cart'][$product_id])){
            $_SESSION['cart'][$product_id] = 0;
        } 
            
        $_SESSION['cart'][$product_id] += $quantity;
    }

    function getShoppingCart() {
        if (isset($_SESSION['cart'])) {
            return $_SESSION['cart'];
        } else {
            createShoppingCart();
            return $_SESSION['cart'];
        }
    }
?>