



<?php //login.php
    require 'connect.php'; //using require will include the connect.php file each time it is called.
            
    $query = " CREATE TABLE booklists (
               id  INT UNSIGNED NOT NULL PRIMARY KEY, 
               title VARCHAR (100) NOT NULL,
               author VARCHAR(50) NOT NULL,
               genre VARCHAR(30) NOT NULL,
               year INT UNSIGNED NOT NULL           
               )";
    
    $result = $conn->query($query);
    
    if (!$result) 
    {
        die($conn->error);
        echo '<br> Your Query failed';
    } 
    else
    {
        echo '<br> Your table has been created';
    }

    $conn->close(); 
?>


