<?php
    
	function getWebshopHeader() {
        return "Webshop";
    }
    
    function showWebshopBody($data) {
     
    echo '<h2>Ons assortiment</h2>';
    print_r($_SESSION);
    echo '<br><br>';
    showWebshopItems($data);
    }

    function showWebshopItems($data) {
        
        $amountOfItems = count($data['items'][0]);

        //Geeft per product het product_id, name, description, price en product_picture_location weer 
        for ($i = 0; $i < $amountOfItems; $i++){
            echo '<a class="productlink" href="index.php?page=' . $data['items'][$i]['product_id'] . '"><div>' .
            'Product id: ' . $data['items'][$i]['product_id'] . '<br>' .
            'Artikel: ' . $data['items'][$i]['name'] . '<br>' .
            'Beschrijving: ' . $data['items'][$i]['description'] . '<br>' .
            'Prijs: €' . $data['items'][$i]['price'] . '<br>' .
            '<img src="' . $data['items'][$i]['product_picture_location'] . '" alt="Een foto">' .
            '</div></a>';
            
            if (isUserLoggedIn()) {
                showFormStart();
                echo '<input type="hidden" name="page" value="webshop">
                <input type="hidden" name="item" value="' . $data['items'][$i]['product_id'] . '">
                <input type="submit" value="+">
                </form>';     
            }
        }
            
    }
?>