<?php
session_start();
include('db.php');

// Check if the user is logged in and has the super_admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'super_admin') {
    header('Location: login.php');
    exit();
}

$image_id = $_GET['id'];
$sql = "SELECT * FROM gallery WHERE id = '$image_id'";
$result = $conn->query($sql);
$image = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $image_url = ''; // Initialize variable for new image URL

    // Handling file upload
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
        $sql = "UPDATE gallery SET title = '$title', category = '$category', description = '$description', image_data = '$image_url' WHERE id = '$image_id'";

        if ($conn->query($sql)) {
            echo "<script>alert('Image updated successfully!');</script>";
            header('Location: view_gallery.php');
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        // If no new image was uploaded, just update other fields
        $sql = "UPDATE gallery SET title = '$title', category = '$category', description = '$description' WHERE id = '$image_id'";
        if ($conn->query($sql)) {
            echo "<script>alert('Image details updated successfully!');</script>";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS for Edit Image Page -->
    <link href="css/admin/edit_image.css" rel="stylesheet">
    
    <title>Edit Image</title>
</head>
<body>
    <div class="container">
        <h2>Edit Image</h2>
        <form action="edit_image.php?id=<?php echo $image_id; ?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($image['title']); ?>" required>
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" class="form-control" required>
                    <option value="playing" <?php echo $image['category'] == 'playing' ? 'selected' : ''; ?>>Playing</option>
                    <option value="learning" <?php echo $image['category'] == 'reading' ? 'selected' : ''; ?>>learning</option>
                    <option value="other" <?php echo $image['category'] == 'drawing' ? 'selected' : ''; ?>>Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" class="form-control" required><?php echo htmlspecialchars($image['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="image">Choose Image:</label>
                <input type="file" name="image" class="form-control-file" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-custom">Update Image</button>
            <a href="view_gallery.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
