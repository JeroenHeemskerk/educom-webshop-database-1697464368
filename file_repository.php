<?php
    
    function connectToDatabase() {        
        $servername = "localhost";
        $username = "WebShopUser";
        $password = "Testtest!";
        $dbname = "nicks_webshop";
        
        //Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        //Check connection
        if (!$conn) {
            die('Connection failed: ' . mysqli_connect_error());
        }
            
        return $conn;
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
            if ($row != False) {
                return array ('name' => $row["name"], 'email' => $row["email_address"],
                'password' => $row["password"]);
            } else {
                throw new Exception('Een lege regel is door de database gegeven in de functie findUserByEmail in file_repository.php');
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        } finally {
            disconnectFromDatabase($conn);
        }
    }
    
    function registerNewAccount($data) {
        
        $conn = connectToDatabase();
        
        $sql = "INSERT INTO users (name, email_address, password)
        VALUES ('" . $data['name'] . "', '" . $data['email'] . "', '" . $data['password'] . "')";

        mysqli_query($conn, $sql);
        
        $sql = "SELECT name, email_address, password FROM users WHERE email_address='" . $data['email'] . "'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        
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