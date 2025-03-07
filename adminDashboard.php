<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Favicon -->
    <link href="img/favicon.png" rel="icon" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS for adminDashboard -->
    <link href="css/admin/adminDashboard.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <div class="logo">
                <img src="img/favicon.png" alt="SchoolHub Logo" style="height: 30px;">
                <span>Wonder Kids</span>
            </div>
            <button class="navbar-toggler" type="button" onclick="toggleSidebar()">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="d-flex">
        <div class="sidebar" id="sidebar">
            <h5>Welcome, <?php echo $_SESSION['username']; ?></h5>
            <?php if ($role === 'super_admin'): ?>
                <a href="view_gallery.php" target="contentFrame" class="active" onclick="setActive(this)">
                    <i class="bi bi-image-fill"></i> View Gallery
                </a>
                <a href="view_carousel.php" target="contentFrame"  onclick="setActive(this)">
                    <i class="bi bi-image-fill"></i> HomePage carousel
                </a>
                <a href="view_contacts.php" target="contentFrame" onclick="setActive(this)">
                    <i class="bi bi-person-circle"></i> Contacts
                </a>
                <button class="signout-button" onclick="signOut()">Sign Out</button>
            <?php elseif ($role === 'general_admin'): ?>
                <a href="view_gallery.php" target="contentFrame" class="active" onclick="setActive(this)">
                    <i class="bi bi-image"></i> View Gallery
                </a>
                <a href="view_carousel.php" target="contentFrame"  onclick="setActive(this)">
                    <i class="bi bi-image-fill"></i> HomePage carousel
                </a>
                <a href="view_contacts.php" target="contentFrame" onclick="setActive(this)">
                    <i class="bi bi-person-circle"></i> Contacts
                </a>
                <button class="signout-button" onclick="signOut()">Sign Out</button>
            <?php endif; ?>
        </div>
        <div class="content">
            <iframe name="contentFrame" src="view_gallery.php"></iframe>
        </div>
    </div>

    <!-- Include custom JavaScript for admin functionality -->
    <script src="js/admin.js"></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
    
    <!-- Include Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include Bootstrap Icons JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.js"></script>

</body>
</html>
