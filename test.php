<?php
$servername = "localhost";
$username = "WebShopUser";
$password = "Testtest!";
$dbname = "nicks_webshop";

//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
//Check connectionif ($conn
if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}
echo 'Connected succesfully<br>';

/*
//Nieuw record klaar zetten
$sql = "INSERT INTO users (name, email_address, password)
VALUES ('Bob', 'bob@hotmail.com', 'bob')";

//Nieuw record toevoegen
if (mysqli_query($conn, $sql)) {
    echo 'New record created successfully';
} else {
    echo 'Error: ' . $sql . '<br>' . mysqli_error($conn);
}*/

$sql = "SELECT user_id, name, email_address, password FROM users";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    //output data van elke rij
    while ($row = mysqli_fetch_assoc($result)) {
        echo 'user_id: ' . $row["user_id"] . ' - Name: ' . $row["name"] . ' - Emailadres: ' .
        $row["email_address"] . ' - Wachtwoord: ' . $row["password"] . '<br>';
    }
} else {
    echo "Geen resultaten";
}


mysqli_close($conn);

//user_id name email_address password

?>