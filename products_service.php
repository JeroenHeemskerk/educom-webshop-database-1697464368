<?php

    function getWebshopItemDetails($page) {

        try {
            $item = getWebshopItem($page);
        }
        catch(Exception $e){
            $genericErr = "Helaas kunnen wij dit product op dit moment niet laten zien. Probeer het later opnieuw.";
            logError($e->getMessage()); //Schrijf $e naar log functie
        }

        return array("item" => $item);
    }

    function getWebshopItems() {
    
    try {
        $items = getAllItems();
    }
    catch(Exception $e){
        $genericErr = "Helaas kunnen wij de producten op dit moment niet laten zien. Probeer het later opnieuw.";
        logError($e->getMessage()); //Schrijf $e naar log functie
    }
    

    return array("items" => $items);
    }
?>