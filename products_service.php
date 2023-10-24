<?php

    function getWebshopProductDetails($product_id) {
        
        $genericError = "";
        try {
            $product = getWebshopProduct($product_id);
        }
        catch(Exception $e) {
            $genericError = "Helaas kunnen wij dit product op dit moment niet laten zien. Probeer het later opnieuw.";
            logError($e->getMessage()); //Schrijf $e naar log functie
        }

        return array('product' => $product, 'genericError' => $genericError);
    }

    /*function getSpecificProductDetails($product_ids) {

        $genericError = "";
        try {
            $products = getSpecificProducts($product_ids);
        }
        catch(Exception $e) {
            $genericError = "Helaas kunnen wij de producten op dit moment niet laten zien. Probeer het later opnieuw.";
            logError($e->getMessage()); //Schrijf $e naar log functie
        }

        return $products;
    }*/

    function getWebshopProducts() {
    
        $genericError = "";
        try {
            $products = getAllProducts();
        }
        catch(Exception $e) {
            $genericError = "Helaas kunnen wij de producten op dit moment niet laten zien. Probeer het later opnieuw.";
            logError($e->getMessage()); //Schrijf $e naar log functie
        }    

        return array('products' => $products, 'genericError' => $genericError);
    }

    function doesProductExist($product_id) {
        return !empty(getWebshopProduct($product_id));
    }
?>