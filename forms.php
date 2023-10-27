<?php

    function showFormField($fieldName, $label, $inputType, $data, $options = "") {        
		
        switch ($inputType){
            case("select"):
                if ($data['salutation'] == $options){
                    echo '<option value="' . $options . '" selected>' . $label . '</option>';
                } else {
                    echo '<option value="' . $options. '">' . $label . '</option>';
                }
                break;
            case ("text"):
                echo '<label for="' . $fieldName . '">' . $label . '</label> ';
                echo '<input type="text" id="' . $fieldName .  '" name="' . $fieldName . '"';
                echo 'value="' . $data . '">';
                showErrorSpan($options);
                echo '<br>';
                break;
            case ("radio"):
                if ($data['contactmode'] == $options){
                    echo '<input type="radio" checked = "checked id="' . $fieldName . '" name="' . $fieldName . '" value="' . $options . '">';
                    echo '<label for="' . $fieldName . '">' . $label . '</label><br>';
                } else {
                    echo '<input type="radio" id="' . $fieldName . '" name="' . $fieldName . '" value="' . $options . '">';
                    echo '<label for="' . $fieldName . '">' . $label . '</label><br>';
                }
                break;
            case ("textarea"):
                echo '<label for="' . $fieldName . '">' . $label . '</label>';
                showErrorSpan($data['errMessage']);
                echo '<br>';
                echo '<textarea id="' . $fieldName . '" name="' . $fieldName . '"' . $options . '">'; echo $data['message'] . '</textarea>';
            }
    }

    function showErrorSpan($error) {
        echo '<span> ' . $error . '</span>';
    }

    function showFormStart() {
        echo '<br><form method="post" action="index.php">'; 
    }
        
    function showFormEnd() {
        echo '<input type="submit" value="Verzenden">';
        echo '</form>';
    }

    function showAddToCartAction($productId, $page, $buttonText) {
        if (isUserLoggedIn()) {
            showFormStart();
            echo '<input type="hidden" name="page" value="' . $page . '">' .
            '<input type="hidden" name="product_id" value="' . $productId . '">' .
            '<input type="hidden" name="userAction" value="addToCart">';
            showFormField('quantity', 'Aantal', 'text');
            echo '" placeholder="0">';
            echo '<input type="submit" value="' . $buttonText . '">';
            echo '</form>';     
        }
    }

    function showBuyAction($buttonText) {
        showFormStart();
            echo '<input type="hidden" name="page" value="cart">'; 
            echo '<input type="hidden" name="userAction" value="completeOrder">';
            echo '<input class="buyActionButton" type="submit" value="' . $buttonText . '">';
    }
?>