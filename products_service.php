<?php

    function getWebshopProductDetails($page) {

        try {
            $product = getWebshopProduct($page);
        }
        catch(Exception $e){
            $genericErr = "Helaas kunnen wij dit product op dit moment niet laten zien. Probeer het later opnieuw.";
            logError($e->getMessage()); //Schrijf $e naar log functie
        }

        return array("product" => $product);
    }

    function getWebshopProducts() {
    
    try {
        $products = getAllProducts();
    }
    catch(Exception $e){
        $genericErr = "Helaas kunnen wij de producten op dit moment niet laten zien. Probeer het later opnieuw.";
        logError($e->getMessage()); //Schrijf $e naar log functie
    }
    

    return array("products" => $products);
    }
?>