<?php
    
	function getWebshopHeader() {
        return "Webshop";
    }
    
    function showWebshopBody($data) {
     
        echo '<h2>Ons assortiment</h2>';
        print_r($_SESSION);
        echo '<br><br>';
        showWebshopProducts($data);
    }

    function showWebshopProducts($data) {
        
        $amountOfProducts = count($data['products'][0]);

        //Geeft per product het product_id, name, description, price en product_picture_location weer 
        for ($i = 0; $i < $amountOfProducts; $i++){
            echo '<a class="productlink" href="index.php?page=' . $data['products'][$i]['product_id'] . '"><div>' .
            'Product id: ' . $data['products'][$i]['product_id'] . '<br>' .
            'Artikel: ' . $data['products'][$i]['name'] . '<br>' .
            'Beschrijving: ' . $data['products'][$i]['description'] . '<br>' .
            'Prijs: €' . $data['products'][$i]['price'] . '<br>' .
            '<img src="' . $data['products'][$i]['product_picture_location'] . '" alt="Een foto">' .
            '</div></a>';
            
            showIncrementButton($data['products'][$i]['product_id'], 'webshop');
        }
            
    }
?>