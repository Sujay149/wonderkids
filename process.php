<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); 
    $mobile = filter_var(trim($_POST['mobile']), FILTER_SANITIZE_STRING);
    $class = filter_var(trim($_POST['class']), FILTER_SANITIZE_STRING);
    $message = filter_var(trim($_POST['message']), FILTER_SANITIZE_STRING);

    // Use prepared statements for safer insertion
    $stmt = $conn->prepare("INSERT INTO contact_form (name, email, mobile, class, message) VALUES (?, ?, ?, ?, ?)"); // Updated SQL
    if ($stmt === false) {
        printf("Error: %s", $conn->error);
        exit;
    }
    $stmt->bind_param("sssss", $name, $email, $mobile, $class, $message); // Updated binding

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        printf("Error: %s", $stmt->error);
    }
    $stmt->close();
    $conn->close();
}
?>