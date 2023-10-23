<?php
    function checkEmail($email) {
		
        if (empty($email)) {			
            return "Emailadres moet ingevuld zijn";  
			
        //Als email niet leeg is wordt gekeken of er sprake is van een valide emailadres
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return "Vul een valide emailadres in";
        } 
		
		return "";
    }
    
    function checkNewEmail($email) {
		
        //doesEmailExist staat in user_service.php
        if (doesEmailExist($email)) {
            return "Dit emailadres is al in gebruik";
        }
        return "";
    }

    function checkName($name) {    
		
		if (empty($name)) {
			return "Naam moet ingevuld zijn";

		//Als name niet leeg is wordt gekeken of er enkel letters en whitespaces ingevuld zijn
		} else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
			return "Enkel letters en whitespaces zijn toegestaan";
		} else {
			return "";
		}
    }
    
    function checkPassword($password) {   
	
        if ($password == ""){
            return "Er is geen wachtwoord opgegeven";
        }
    }

    function checkProduct_id($product_id){

        if ($product_id <= 0 || $product_id >= 9999999999 || !is_numeric($product_id)) {
            return "Het toe te voegen product bestaat niet";
        }
    }

    function checkQuantity($quantity) {

        if (!is_numeric($quantity)) {
            return "Er moet bij 'Aantal' een getal opgegeven worden";
        } else if ($quantity <= 0) {
            return "De hoeveelheid aan te schaffen producten moet hoger dan 0 zijn";
        } else if ($quantity > 100) {
            return "Er kunnen niet meer dan 100 van hetzelfde product tegelijkertijd aangeschaft worden";
        }
    }
    
    function checkRegisterPassword($password, $passwordTwo) {
		
		if (empty($passwordTwo)) {
			return "Het wachtwoord moet ter controle nog een keer ingevuld worden";
			
		//Als password niet leeg is wordt gekeken of er sprake is van een tweede wachtwoord welke gelijk moet zijn aan de eerste
		} else if ($password == $passwordTwo) {
			return "";
		} else {
			return "De wachtwoorden moeten gelijk zijn aan elkaar";
		}
			
    }
    
    function testInput($input) {
        
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }

    function validateContact() {
    
        $salutation = $name = $email = $phonenumber = $contactmode = $message = "";
        $errSalutation = $errName = $errMail = $errPhonenumber = $errContactmode = "";
        $valid = False;        
        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            //de input vanuit het formulier wordt hier in variabelen gezet en vervolgens opgeschoond door middel van de testInput functie
            $salutation = testInput(getPostVar("salutation"));
            $name = testInput(getPostVar("name"));
            $email = testInput(getPostVar("email"));
            $phonenumber = testInput(getPostVar("phonenumber"));
            $message = testInput(getPostVar("message"));
			$contactmode = testInput(getPostVar("contactmode"));
			
			if (empty($salutation)) {
				
                $errSalutation = "Aanhef moet ingevuld zijn";                
			//Als name niet leeg is wordt gekeken of er enkel letters en whitespaces ingevuld zijn                
            } else if (!($salutation == "mr." || $salutation == "mrs." || $salutation == "neither")) {                
                $errSalutation = "Enkel 'Dhr.', 'Mvr.' of 'Geen van beide' zijn valide input";
            }
            
            if (empty($name)) {
				
                $errName = "Naam moet ingevuld zijn";				
			//Als name niet leeg is wordt gekeken of er enkel letters en whitespaces ingevuld zijn
			} else if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                    $errName = "Enkel letters en whitespaces zijn toegestaan";
            }       
            
            if (empty($email)) {
				
                $errMail = "Emailadres moet ingevuld zijn";
            //Als email niet leeg is wordt gekeken of er sprake is van een valide emailadres
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errMail = "Vul een valide emailadres in";
            }             
            
            if (empty($phonenumber)) {
                
				$errPhonenumber = "Telefoonnummer moet ingevuld zijn";
				
            //Als phonenumber niet leeg is wordt gekeken of phonenumber enkel uit nummers bestaat
            } else if (!is_numeric($phonenumber)) {
                    $errPhonenumber = "Enkel cijfers zijn toegestaan";
            }             
            
            //Als contactmode leeg is wordt een foutmelding opgenomen
            if (empty($contactmode)) {
				
				$errContactmode = "U moet een contactwijze kiezen";                
            }
        
            //Als er geen errors voorkomen wordt validInput op true gezet zodat de bedankpagina getoond kan worden
            if (($errSalutation == "") && ($errName == "") && ($errMail == "") && ($errPhonenumber == "") && ($errContactmode == "")){
            
                $valid = True;
            } else {
                $valid = False;
            }        
        }
        
        
        return array('salutation' => $salutation, 'errSalutation' => $errSalutation, 'name' => $name, 'errName' => $errName, 'email' => $email, 'errMail' => $errMail, 'phonenumber' => $phonenumber,
        'errPhonenumber' => $errPhonenumber, 'contactmode' => $contactmode, 'errContactmode' => $errContactmode, 'message' => $message, 'valid' => $valid, 'page' => "");    
    }
    
    function validateLogin() {
    
        $email = $password = $name = $errMail = $errPassword = $genericError = "";
        $valid = False;
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
            //Eerst worden ongewenste karakters verwijderd
            $email = testInput($_POST["email"]);
            $password = testInput($_POST["password"]);
        
            //Vervolgens wordt gekeken of correcte input gegeven is
            $errMail = checkEmail($email);
            $errPassword = checkPassword($password);
        
            //Indien geen foutmeldingen gegeven zijn bij het checken van het emailadres en password is sprake van valide input
            if ($errMail == "" && $errPassword == "") {
                
                try {
                    $user = authenticateUser($email, $password);
                    
                    if (!empty($user)) {
                        $name = $user['name'];
                    $valid = True;
                    } else {
                        $errMail = "Opgegeven emailadres is niet gekoppeld aan een gebruiker of incorrect wachtwoord";
                    }                
                }
                catch (Exception $e) {
                    $genericError = "Door een technisch probleem is inloggen helaas niet mogelijk op dit moment. Probeer het op een later moment nogmaals<br>";
                    logError($e->getMessage()); //Schrijf $e naar log functie
                }
            }
        }
    
        return array('email'=> $email, 'errMail' => $errMail, 'name' => $name, 'password' => $password, 'errPassword' => $errPassword, 'genericError' => $genericError, 'valid' => $valid, 'page' => "");
    }
    
    function validateRegister() {
    
        $name = $email = $password = $passwordTwo = $errName = $errMail = $errPassword = $genericError = "";
        $valid = False;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
            //Eerst worden ongewenste karakters verwijderd
            $name = testInput(getPostVar("name"));
            $email = testInput(getPostVar("email"));
            $password = testInput(getPostVar("password"));
            $passwordTwo = testInput(getPostVar("passwordTwo"));
        
            //Vervolgens wordt gekeken of correcte input gegeven is
            $errName = checkName($name);
            $errMail = checkEmail($email);
			$errPassword = checkPassword($password);
        
            //Nadat een correct emailadres is opgegeven wordt ook gekeken of er sprake is van een nieuw uniek emailadres
            if ($errMail == "") {
                    
                try {
                    $errMail = checkNewEmail($email);
                } catch (Exception $e) {
                    $genericError = "Door een technisch probleem is registreren helaas niet mogelijk op dit moment. Probeer het op een later moment nogmaals.<br>";
                    logError($e->getMessage()); //Schrijf $e naar log functie (deze doet niks op dit moment want is conform opdracht niet geïmplementeerd)
                }
			}				
        
                //Vervolgens wordt bekeken of er wachtwoorden opgegeven zijn, waarna de wachtwoorden met elkaar vergeleken worden
			if ($errPassword == ""){
                $errPassword = checkRegisterPassword($password, $passwordTwo);
			}
        
                //Indien sprake is van correcte input wordt een nieuw account aangemaakt en de gebruiker geredirect naar de loginpagina
            if ($errName == "" && $errMail == "" && $errPassword == "") {
                $valid = True;        
            }            
        }
    
        return array('name' => $name, 'errName' => $errName, 'email' => $email, 'errMail' => $errMail, 'password' => $password, 'passwordTwo' => $passwordTwo, 'errPassword' => $errPassword, 'genericError' => $genericError, 'valid' => $valid, 'page' => "");
    }

    function validateAddingProductToShoppingCart() {

        $product_id = $quantity = $errProduct_id = $errQuantity = $genericError =  "";
        $valid = False;

        if ($_SERVER["REQUEST_METHOD"] == "POST"){

            //Eerst worden ongewenste karakters verwijderd
            $product_id = testInput(getPostVar("product_id"));
            $quantity = testInput(getPostVar("quantity"));

            //$quantity wordt naar een integer gecast zodat er mee gerekend kan worden
            $quantity = (int)$quantity;

            //Vervolgens wordt gekeken of correcte input gegeven is
            $errProduct_id = checkProduct_id($product_id);
            $errQuantity = checkQuantity($quantity);
            
            //Indien sprake is van correcte input wordt het product aan de cart toegevoegd
            if ($errProduct_id == "" && $errQuantity == "") {

                try {
                    if (doesProductExist($product_id)) {
                        $valid = True;
                    }
                } catch(Exception $e) {
                    $genericErr = "Er is iets fout gegaan. Een niet bestaand product is opgevraagd. Probeer het later opnieuw.";
                    logError($e->getMessage()); //Schrijf $e naar log functie
                }
            }
        }

        return array('product_id' => $product_id, 'quantity' => $quantity, 'errProduct_id' => $errProduct_id, 'errQuantity' => $errQuantity, 'genericError' => $genericError, 'valid' => $valid);
    }
?>