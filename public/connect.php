<?php

    $host = "localhost";
    $db_name = "elite_team";
    $username = "root";
    $password = "";

    $conn = mysqli_connect(
        $host,
        $db_name,
        $username,
        $password
    );

    if(!$conn){
        die("Something went wrong!");
    }

?>