<?php

    define("SALUTATIONS", array("mr." => "Dhr.", "mrs." => "Mvr.", "neither" => "Geen van beide"));
    define("COMM_PREFS", array("email" => "E-mail", "phone" => "Telefoon"));
    
	function getContactHeader() {
        return "Contact";
    }
    
    function showContactBody($data) {    
        showFormStart();    
    
        //Aanhefkeuze
        echo '<label for="salutation"> Aanhef:</label><br>';        
            echo '<select name="salutation" id="salutation">';
            if ($data['salutation'] == "mr."){
                echo '<option value="mr." selected>Dhr.</option>';
            } else {
                echo '<option value="mr.">Dhr.</option>';
            }
            if ($data['salutation'] == "mrs."){
                echo '<option value="mrs." selected>Mvr.</option>';
            } else {
                echo '<option value="mrs.">Mvr.</option>';
            }
            if ($data['salutation'] == "neither"){
                echo '<option value="neither" selected>Geen van beide</option>';
            } else {
                echo '<option value="neither">Geen van beide</option>';
            }
        echo '</select><span>'; echo $data['errSalutation']; echo '</span><br>';
        
    
        //Formulier met naam, emailadres en telefoonnummer
        showFormField("name", "Naam:", "text");
        echo 'value="' . $data['name'] . '"><span>' . $data['errName'] . '</span><br>';
        showFormField("email", "Emailadres:", "text");
        echo 'value="' . $data['email'] . '"><span>' . $data['errMail'] . '</span><br>';
        showFormField("phonenumber", "Telefoonnummer:", "text");
        echo 'value="' . $data['phonenumber'] . '"><span>' . $data['errPhonenumber'] . '</span><br><br>';
    
        //Radio button met contactwijze
        echo '<label for="contactmode1">Contactwijze:</label><span> ' . $data['errContactmode'] . '</span><br>
            <input type="radio" id="contactmode" name="contactmode" value="email">
            <label for="contactmode">Email</label><br>
            <input type="radio" id="contactmode" name="contactmode" value="phone">
            <label for="contactmode">Telefoon</label><br><br>';
    
        //Mogelijkheid tot verzenden bericht
        echo '<label for="message">Uw bericht:</label><br>
            <textarea id="message" name="message" rows="3" cols="50"></textarea><br><br>';
    
        //Verborgen variabele om ervoor te zorgen dat de contactpagina gevonden kan worden middels de getRequestedPage functie van index.php
        echo '<input type="hidden" name="page" value="contact">';
    
        //Verzendknop
        showFormEnd();    
        }        
?>