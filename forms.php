<?php

    function showFormField($fieldName, $label, $inputType, $data) {        
		
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

    function showIncrementButton($product, $page) {
        if (isUserLoggedIn()) {
            showFormStart();
            echo '<input type="hidden" name="page" value="' . $page . '">
            <input type="hidden" name="product" value="' . $product . '">
            <input type="submit" value="+">
            </form>';     
        }
    }
?>