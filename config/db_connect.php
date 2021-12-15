<?php

    //connect to database
    $conn= mysqli_connect('localhost', 'Dave', '11110000', 'biodataform');

    //to check connection
    if (!$conn){
        echo 'connection error:'. mysqli_connect_error();
    }


?>