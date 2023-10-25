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

    function getCartLines($cart) {
    
        $genericError = "";
        $cartLines = array();
        $total = 0;
        try {
            $products = getAllProducts(); // getSpecificProducts(array_keys($cart))
            foreach ($cart as $product_id => $amount) {
                $product = $products[$product_id];
                $subTotal = $product['price'] * $amount;
                $total += $subTotal;
                $cartLines[$product_id] = array('name' => $product['name'], 'description' => $product['description'], 'price' => $product['price'], 'product_picture_location' => $product['product_picture_location'], 'amount' => $amount, 'subTotal' => $subTotal);
            }
        }
        catch(Exception $e) {
            $genericError = "Helaas kunnen wij de producten op dit moment niet laten zien. Probeer het later opnieuw.";
            logError($e->getMessage()); //Schrijf $e naar log functie
        }    

        return array('cartLines' => $cartLines, 'total' => $total, 'genericError' => $genericError);
        
    }

    function writeOrder($data) {

        $genericError = "";
        $valid = False;
        try {
            writeOrderToDatabase($data['cartLines']);
        } catch (Exception $e) {
            $genericError = "Door een technisch probleem is het op dit moment helaas niet mogelijk om iets aan te schaffen. Probeer het op een later moment nogmaals.<br>";
            logError($e->getMessage()); //Schrijf $e naar log functie (deze doet niks op dit moment want is conform opdracht niet geïmplementeerd)
        }

        if (empty($genericError)) {
            $valid = True;
        }
        return array('genericError' => $genericError, 'valid' => $valid);
    }

    function doesProductExist($product_id) {
        return !empty(getWebshopProduct($product_id));
    }
?>