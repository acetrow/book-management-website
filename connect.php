<?php // connect.php allows connection to the database
    $hn = 'localhost';   // changed from 'mysql' to 'localhost'
    $db = '23db391';
    $un = 'root';        // XAMPP default username
    $pw = '';            // XAMPP default password is empty
    
    $conn = new mysqli($hn, $un, $pw, $db);
    
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error . '<br>Unfortunately you could not be connected to the database. Please check you have the correct credentials.');
    } else {	
        echo '<br>You have connected to the database successfully <br><br>';
    }
?>
