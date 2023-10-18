<?php
    
    function connectToDatabase() {        
        $servername = "localhost";
        $username = "WebShopUser";
        $password = "Testtest!";
        $dbname = "nicks_webshop";
        
        //Create connectie
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        //Check connectie en laat een error zien indien database niet te bereiken is
		try {
			if (!$conn) {
				throw new Exception('connectie met database is niet tot stand gekomen');
			}
		} catch (Exception $e) {
			echo 'Error: ' . $e->getMessage();
		}		
            
        return $conn;
    }
    
    function disconnectFromDatabase($conn) {        
        mysqli_close($conn);
    }
    
    function findUserByEmail($email) {
        
        $conn = connectToDatabase();
        
        try {
			$row = findEmailInDatabase($email, $conn);
         
            if ($row != False) {
                return array ('name' => $row["name"], 'email' => $row["email_address"],
                'password' => $row["password"]);
            }
        }
		finally {
            disconnectFromDatabase($conn);
        }
    }
	
	function findEmailInDatabase($email, $conn) {
		//Functie construeert de query om de rij met het emailadres te vinden en geeft deze rij als array terug
		$sql = "SELECT name, email_address, password FROM users WHERE email_address='" . $email . "'";
        $result = mysqli_query($conn, $sql);            
		
		//Hier kan een check maar ik weet niet wat $result is als het echt fout gaat
		
        return mysqli_fetch_assoc($result);   
	}
    
    function registerNewAccount($data) {
        
        $conn = connectToDatabase();
        
        $sql = "INSERT INTO users (name, email_address, password)
        VALUES ('" . $data['name'] . "', '" . $data['email'] . "', '" . $data['password'] . "')";

        mysqli_query($conn, $sql);
        
		//Check of nieuwe gebruiker is toegevoegd aan de database
		$row = findEmailInDatabase($data['email'], $conn);        
        try {
            if ($data['email'] != $row["email_address"]) {
                throw new Exception('registerNewAccount in file_repository.php heeft de nieuwe user niet toegevoegd');
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }        

        disconnectFromDatabase($conn);        
    }
?>