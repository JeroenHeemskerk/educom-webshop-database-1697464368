<?php
    
	function getRegisterHeader() {
        return "Register";
    }
    
    function showRegisterBody($data){
        
        //Formulier met naam, emailadres en emailadrescheck
        echo '<br>
            <form method="post" action="index.php">
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" placeholder="John Doe" value="' . $data['name'] . '"><span>' . $data['errName'] . '</span><br>
            <label for="email">Emailadres:</label>
            <input type="text" id="email" name="email" placeholder="j.doe@example.com" value="' . $data['email'] . '"><span>' . $data['errMail'] . '</span><br>
            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" value="' . $data['password'] . '"><span>' . $data['errPassword'] . '</span><br>
            <label for="passwordTwo">Herhaal uw wachtwoord:</label>
            <input type="password" id="passwordTwo" name="passwordTwo" value="' . $data['passwordTwo'] . '"><br>';
            
        //Verborgen variabele om ervoor te zorgen dat de registerpagina gevonden kan worden middels de getRequestedPage functie van index.php
        echo '<input type="hidden" name="page" value="register">';
        
        //Verzendknop
        echo '<input type="submit" value="Verzenden">
        </form>';
    }
?>