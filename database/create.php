<?php
session_start();
include('database.php'); // Ensure this file is in the same directory

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middle_initial']; // Match database column name
    $lastname = $_POST['lastname'];
    $suffix = $_POST['suffix'];
    $program = $_POST['program'];
    $year = $_POST['year'];
    $age = $_POST['age'];

    // Insert query
    $sql = "INSERT INTO tbstudent (firstname, middle_initial, lastname, suffix, program, year, age) 
            VALUES ('$firstname', '$middlename', '$lastname', '$suffix', '$program', '$year', '$age')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "created";
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);

    
    header("Location: ../dashboard.php"); // Redirect after inserting
    exit();
}
?>