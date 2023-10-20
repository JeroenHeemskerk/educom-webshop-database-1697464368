<?php
    
	function getWebshopHeader() {
        return "Webshop";
    }
    
    function showWebshopBody() {
     
    echo '<h2>Dit is de webshop</h2>
     <p>Kijk naar al deze items die er nog niet in staan</p>';

    showWebshopItems();
    }

    function showWebshopItems() {

        $items = getWebshopItems();
        $amountOfItems = count($items);

        for ($i = 0; $i < $amountOfItems; $i++){
            echo 'Rij ' . $i + 1 . '<br>' .
            'Product_id: ' . $items[$i]["product_id"] . '<br>' .
            'Name: ' . $items[$i]["name"] . '<br>' .
            'Description' . $items[$i]["description"] . '<br>' .
            'Price ' . $items[$i]["price"] . '<br>' .
            'product_picture_location' . $items[$i]["product_picture_location"] . '<br><br>';
        }
        
    }
?>