<?php
session_start();
include('db.php');

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Handling file upload
    $image_url = '';
    if (isset($_FILES['image'])) {
        $file = $_FILES['image'];

        // Debug: Show file upload error code
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo "File upload error code: " . $file['error'];
            exit();
        }

        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileType = $file['type'];

        // Extract file extension and make sure it's an image
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        // Check for valid file extension and size (limit size to 5MB)
        if (in_array($fileExtension, $allowedExtensions) && $fileSize <= 5 * 1024 * 1024) {
            // Generate a unique name for the file to avoid collisions
            $newFileName = uniqid('img_', true) . '.' . $fileExtension;
            $uploadDir = 'uploads/images/';

            // Create the uploads folder if it doesn't exist
            if (!is_dir($uploadDir)) {
                if (!mkdir($uploadDir, 0777, true)) {
                    echo "Failed to create directories: $uploadDir";
                    exit();
                }
            }

            $destPath = $uploadDir . $newFileName;

            // Move the file to the destination folder
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $image_url = $destPath;  // Save the path of the image
            } else {
                echo "Error moving the uploaded file to: " . $destPath . "<br>";
            }
        } else {
            echo "Invalid file type or file size exceeds the limit (5MB).";
        }
    } else {
        echo "No file uploaded.";
    }

    // If an image was uploaded, save the image details in the database
    if ($image_url) {
        $sql = "INSERT INTO gallery (title, image_data, category, description) 
                VALUES ('$title', '$image_url', '$category', '$description')";

        if ($conn->query($sql)) {
            echo "Image added successfully!";
        } else {
            echo "Database error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Image</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS for Add Image page -->
    <link href="css/admin/add_image.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add New Image</h2>
        <form action="add_image.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" class="form-control" name="title" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category:</label>
                <select name="category" class="form-select" required>
                    <option value="playing">Playing</option>
                    <option value="learning">learning</option>
                    <option value="other">other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image:</label>
                <input type="file" class="form-control" name="image" accept="image/jpeg, image/png, image/gif" required>
            </div>

            <button type="submit" class="btn btn-custom">Add Image</button>
            <a href="view_gallery.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
