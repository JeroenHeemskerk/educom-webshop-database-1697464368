<?php
    
    function connectToDatabase() {        
        $servername = "localhost";
        $username = "WebShopUser";
        $password = "Testtest!";
        $dbname = "nicks_webshop";
        
        //Create connectie
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        //Check connectie en laat een error zien indien database niet te bereiken is
		
		if (!$conn) {
			throw new Exception('Connectie met database is niet tot stand gekomen');
		}
		            
        return $conn;
        
    }
    
    function disconnectFromDatabase($conn) {        
        mysqli_close($conn);
    }
    
    function findUserByEmail($email) {
        
        $conn = connectToDatabase();
        
        $email = mysqli_real_escape_string($conn, $email);
        
        try {
			$sql = "SELECT name, email_address, password FROM users WHERE email_address='" . $email . "'";
			$result = mysqli_query($conn, $sql);            
            
            if ($result == False) {
                throw new Exception('Opgegeven emailadres kon niet worden opgezocht in de database');
            }
            
			$row = mysqli_fetch_assoc($result);                     
            if ($row != Null) {
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
        
        $name = mysqli_real_escape_string($conn, $data['name']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $password = mysqli_real_escape_string($conn, $data['password']);
        
        try{
            $sql = "INSERT INTO users (name, email_address, password)
            VALUES ('" . $name . "', '" . $email . "', '" . $password . "')";

            if (!mysqli_query($conn, $sql)) {
                throw new Exception('Gebruiker kon niet geregistreerd worden in de database');
            }            
        } finally {        
        disconnectFromDatabase($conn);
        }        
    }

    function getWebshopItems() {

        $conn = connectToDatabase();

        //try {
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

            //Output gevonden rijen
            if (mysqli_num_rows($result) > 0) {

                $counter = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    
                    //Counter zorgt ervoor dat een nieuwe rij op de volgende plek in de tweedimensionale array terecht komt
                    $items[$counter] = $row;
                    $counter++;
                }

                return $items;
            }
        //}
    }
?>