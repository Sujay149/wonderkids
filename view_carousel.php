<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role']; // Not being used in this snippet, but you can use it later if needed

// Handle the image upload process
if (isset($_POST['submit']) && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    // Check if there were any upload errors
    if ($image['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $image['tmp_name'];
        $imageName = basename($image['name']); // Sanitize file name
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Validate file extension (only allow images)
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExtension, $allowedExtensions)) {
            $_SESSION['error'] = "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
            header('Location: index.php');
            exit();
        }

        // Generate a unique file name to avoid conflicts
        $newImageName = uniqid('', true) . '.' . $imageExtension;
        $imagePath = 'carousel/' . $newImageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($imageTmpName, $imagePath)) {
            // Insert the image path into the database
            $stmt = $conn->prepare("INSERT INTO images (image_data) VALUES (?)");
            $stmt->bind_param("s", $imagePath);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Image uploaded successfully!";
            } else {
                $_SESSION['error'] = "Failed to upload image to database.";
            }

            $stmt->close();
        } else {
            $_SESSION['error'] = "Failed to move uploaded file.";
        }
    } else {
        $_SESSION['error'] = "Error uploading file: " . $image['error'];
    }
}

$sql = "SELECT * FROM images ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/admin/view_gallery.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Home Page Carousel</h1>

        <!-- Display Success or Error Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Image Upload Form -->
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">Choose an Image</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-warning btn-sm">Upload Image</button>
        </form>

        <h3 class="text-center mt-5">Uploaded Images</h3>

        <!-- Display Image Gallery -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr class="data">
                        <td><img src="<?php echo htmlspecialchars($row['image_data']); ?>" width="100" alt="Image"></td>
                        <td>
                            <a href="delete_img.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
