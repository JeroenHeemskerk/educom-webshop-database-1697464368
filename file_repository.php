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

    function getWebshopProduct($product_id){

        $conn = connectToDatabase();

        $product_id = mysqli_real_escape_string($conn, $product_id);

        try{
            $sql = "SELECT * FROM products WHERE product_id='" . $product_id . "'";
            $result = mysqli_query($conn, $sql);

            if ($result == False) {
                throw new Exception('Opgegeven product kon niet worden gevonden in de database');
            }
            
            $row = mysqli_fetch_assoc($result);
            return $row;
        }finally {
            disconnectFromDatabase($conn);  
        }
    }

    function getAllProducts() {

        $conn = connectToDatabase();

        try {
            $sql = "SELECT * FROM products";
            $result = mysqli_query($conn, $sql);

            if ($result == False) {
                throw new Exception('Producten konden niet uitgelezen worden uit de database');
            }

            $products = array();

            while ($row = mysqli_fetch_assoc($result)) {
                
                $products[$row["product_id"]] = $row;
            }

            return $products;
            
        } finally {
            disconnectFromDatabase($conn);  
        }
    }
?>