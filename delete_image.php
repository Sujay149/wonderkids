<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$image_id = $_GET['id'];

// Fetch the image data to delete the file
$sql = "SELECT * FROM gallery WHERE id = '$image_id'";
$result = $conn->query($sql);
$image = $result->fetch_assoc();

if ($image) {
    // Delete the image file from the server
    $filePath = $image['image_url'];
    if (file_exists($filePath)) {
        unlink($filePath); // Deletes the file
    }

    // Delete the record from the database
    $sql = "DELETE FROM gallery WHERE id = '$image_id'";
    if ($conn->query($sql)) {
        echo "Image deleted successfully!";
        header('Location: view_gallery.php');
        exit();
    } else {
        echo "Error deleting image.";
    }
}
