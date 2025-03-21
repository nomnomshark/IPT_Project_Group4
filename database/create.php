<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $firstname = $_POST['firstname']; 
    $lastname = $_POST['lastname']; 
    $middlename = $_POST['middlename']; 
    $suffix = $_POST['suffix']; 
    $age = $_POST['age'];
    $program = $_POST['program']; 
    $year = $_POST['year']; 

    $sql = "INSERT INTO students (firstname, lastname, middlename, suffix, age, program, year) VALUES ('$firstname', '$lastname', '$middlename', '$suffix', '$age','$program', '$year')"; 

    if (mysqli_query($conn, $sql)) { 
        $_SESSION['status'] = "created"; 
    } else { 
        $_SESSION['status'] = "error"; 
    }

    mysqli_close($conn); 
    header("Location: ../index.php"); 
    exit(); 
}
?> 