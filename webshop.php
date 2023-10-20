<?php
    
	function getWebshopHeader() {
        return "Webshop";
    }
    
    function showWebshopBody() {
     
    echo '<h2>Ons assortiment</h2>';
    showWebshopItems();
    }

    function showWebshopItems() {

        $items = getWebshopItems();
        $amountOfItems = count($items);

        //Geeft per product het product_id, name, description, price en product_picture_location weer 
        for ($i = 0; $i < $amountOfItems; $i++){
            echo '<a class="productlink" href="index.php?page="' . $items[$i]["name"] . '"><div>' .
            'Product id: ' . $items[$i]["product_id"] . '<br>' .
            'Artikel: ' . $items[$i]["name"] . '<br>' .
            'Beschrijving: ' . $items[$i]["description"] . '<br>' .
            'Prijs: €' . $items[$i]["price"] . '<br>' .
            '<img src="' . $items[$i]["product_picture_location"] . '" alt="Een foto">' .
            '</div></a><br>';         
        }
    }
?>