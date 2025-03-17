<?php
    $servername = "localhost";
    $db_name = "iptproject";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, $db_name);

    if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error)
    }
?>