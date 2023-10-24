<?php

    function showFormField($fieldName, $label, $inputType) {        
		
		if ($inputType == "text"){
			echo '<label for="' . $fieldName . '">' . $label . '</label>
			<input type="' . $inputType . '" id="' . $fieldName .  '" name="' . $fieldName . '" ';
		}
    }

    function showFormStart() {
        echo '<br><form method="post" action="index.php">'; 
    }
        
    function showFormEnd() {
        echo '<input type="submit" value="Verzenden">';
        echo '</form>';
    }

    function showAddToCartAction($product_id, $page, $buttonText) {
        if (isUserLoggedIn()) {
            showFormStart();
            echo '<input type="hidden" name="page" value="' . $page . '">' .
            '<input type="hidden" name="product_id" value="' . $product_id . '">' .
            '<input type="hidden" name="action" value="addToCart">';
            showFormField('quantity', 'Aantal', 'text');
            echo '" placeholder="0">';
            echo '<input type="submit" value="' . $buttonText . '">';
            echo '</form>';     
        }
    }

    function showBuyAction($buttonText) {
        showFormStart();
        echo '<input type="hidden" name="page" value="cart"' . 
        '<input type="hidden" name="action" value="completeOrder">';
        echo '<input class="buyActionButton" type="submit" value="' . $buttonText . '">';
    }
?>