<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $imageId = $_GET['id'];

    // Get the image path from the database
    $stmt = $conn->prepare("SELECT image_data FROM images WHERE id = ?");
    $stmt->bind_param("i", $imageId);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row) {
        $imagePath = $row['image_data'];

        // Delete the image file from the server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete the image from the database
        $stmt = $conn->prepare("DELETE FROM images WHERE id = ?");
        $stmt->bind_param("i", $imageId);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Image deleted successfully!";
            header('Location: view_carousel.php');
        } else {
            $_SESSION['error'] = "Failed to delete image from database.";
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Image not found.";
    }
}
