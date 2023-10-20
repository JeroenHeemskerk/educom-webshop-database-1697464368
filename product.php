<?php
    
	function getProductHeader() {
        return "Webshop";
    }
    
    function showProductBody() {

    //Misschien is het beter om met product_id te werken omdat deze uniek is
    $page = getUrlVar('page');
    $item = getWebshopItem($page);
    
    echo '<h2>' . $item["name"] . '</h2>';
    echo '<img src="' . $item["product_picture_location"] . '" class="productpage" alt="Een foto"><br>' .
    'Product id: ' . $item["product_id"] . '<br>' .
    'Artikel: ' . $item["name"] . '<br>' .
    'Beschrijving: ' . $item["description"] . '<br>' .
    'Prijs: €' . $item["price"] . '<br>';
    }
?>