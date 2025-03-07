<?php
session_start();
include('db.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header('Location: adminDashboard.php');
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In Page</title>

    <!-- Favicon -->
    <link href="img/favicon.png" rel="icon" />

    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Include Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts for Noto Sans Japanese -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100&display=swap" rel="stylesheet">

    <!-- Include custom CSS for login page -->
    <link href="css/admin/login.css" rel="stylesheet"></link>

</head>
<body>
    <div class="sign-in-container">
        <img src="img/title.png" alt="Background Image">
        <form method="POST" action="">
            <h3 class="m-3">Sign In</h3>
            <?php if ($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" required>
            </div>
            <div class="mb-3 position-relative">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                <span class="position-absolute end-0 top-50 translate-middle-y me-3" onclick="togglePasswordVisibility()" style="cursor: pointer;">
                    <i id="togglePasswordIcon" class="bi bi-eye-slash"></i>
                </span>
            </div>
            <button type="submit" class="btn btn-primary w-100 mt-3">Sign In</button>
        </form>
    </div>

    <!-- Include custom JavaScript for admin functionality -->
    <script src="js/admin.js"></script>

    <!-- Include Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include Bootstrap Icons JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.js"></script>

</body>
</html>