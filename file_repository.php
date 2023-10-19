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
				throw new Exception('Connectie met database is niet tot stand gekomen in de functie connectToDatabase in file_repository.php');
			}
		} finally {            
        return $conn;
        }
    }
    
    function disconnectFromDatabase($conn) {        
        mysqli_close($conn);
    }
    
    function findUserByEmail($email) {
        
        $conn = connectToDatabase();
        
        try {
			$sql = "SELECT name, email_address, password FROM users WHERE email_address='" . $email . "'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($result);
            
            //Zet onderstaande == op != om de foutmelding te triggeren
            if ($row == False) {
                throw new Exception('Gebruiker is niet opgehaald in de database in de functie findUserByEmail in file_repository.php');
            }
         
            if ($row != NULL) { //false of null
                return array ('name' => $row["name"], 'email' => $row["email_address"],
                'password' => $row["password"]);
            }
        }
		finally {
            disconnectFromDatabase($conn);
        }
    }
    
    function registerNewAccount($data) {
        
        $conn = connectToDatabase();
        
        $sql = "INSERT INTO users (name, email_address, password)
        VALUES ('" . $data['name'] . "', '" . $data['email'] . "', '" . $data['password'] . "')";

        mysqli_query($conn, $sql);
        disconnectFromDatabase($conn);        
    }
?>