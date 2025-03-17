<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $required_fields = ['full_name', 'last_name', 'middle_name', 'age', 'position', 'sex'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || trim($_POST[$field]) === '') {
            $_SESSION['error_message'] = ucfirst(str_replace('_', ' ', $field)) . " is required.";
            header('Location: ../dashboard.php');
            exit();
        }
    }


    $full_name = htmlspecialchars(trim($_POST['full_name']));
    $last_name = htmlspecialchars(trim($_POST['last_name']));
    $middle_name = htmlspecialchars(trim($_POST['middle_name']));
    $age = intval(trim($_POST['age'])); // Ensure it's an integer
    $position = htmlspecialchars(trim($_POST['position']));
    $sex = htmlspecialchars(trim($_POST['sex']));

    // Validate age (must be 18 or older)
    if ($age < 18) {
        $_SESSION['error_message'] = "Age must be 18 or older.";
        header('Location: ../dashboard.php');
        exit();
    }

    // Validate name fields (only letters and spaces allowed)
    if (!preg_match("/^[a-zA-Z\s]+$/", $full_name)) {
        $_SESSION['error_message'] = "Full name can only contain letters and spaces.";
        header('Location: ../dashboard.php');
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $last_name)) {
        $_SESSION['error_message'] = "Last name can only contain letters and spaces.";
        header('Location: ../dashboard.php');
        exit();
    }

    if (!preg_match("/^[a-zA-Z\s]+$/", $middle_name)) {
        $_SESSION['error_message'] = "Middle name can only contain letters and spaces.";
        header('Location: ../dashboard.php');
        exit();
    }

    // Validate sex (must be either "Male" or "Female")
    if (!in_array(strtolower($sex), ['male', 'female'])) {
        $_SESSION['error_message'] = "Invalid sex value.";
        header('Location: ../dashboard.php');
        exit();
    }


    $sql = "INSERT INTO barangay_official (full_name, middle_name, last_name, age, position, sex) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssiss", $full_name, $middle_name, $last_name, $age, $position, $sex);

        // Execute the statement
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Barangay official added successfully!";
        } else {
            $_SESSION['error_message'] = "Something went wrong. Please try again.";
            error_log("Database error: " . $stmt->error);
        }

        $stmt->close();
    } else {
        $_SESSION['error_message'] = "Failed to prepare the database statement.";
        error_log("Database error: " . $conn->error);
    }

    $conn->close();
    header('Location: ../dashboard.php');
    exit();
} else {
    header('Location: ../dashboard.php');
    exit();
}