<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $middlename = $_POST['middlename'];
    $suffix = $_POST['suffix'];
    $age = $_POST['age'];
    $program = $_POST['program'];
    $year = $_POST['year'];

    $sql = "UPDATE students SET firstname='$firstname', lastname='$lastname', middlename='$middlename', suffix='$suffix', age='$age', program='$program', year='$year' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "updated";
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);
    header("Location: ../index.php");
    exit();
}
?>
