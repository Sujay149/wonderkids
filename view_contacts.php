<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: admin/login.php');
    exit();
}

$role = $_SESSION['role'];

// Handle deletion of a submission
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_sql = "DELETE FROM contact_form WHERE id = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->close();
    header('Location: view_contacts.php'); 
    exit();
}

$sql = "SELECT * FROM contact_form ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Contact Form Submissions</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS for view_contacts page -->
    <link href="css/admin/view_contacts.css" rel="stylesheet">
</head>
<body>
    <div class="container">

        <h1 class="text-center">Contact Form Submissions</h1>

        <table>
            <tr>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Class</th>
                <th>Message</th>
                <th>Date Submitted</th>
                <th>Action</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['mobile']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['class']); ?></td>
                    <td><?php echo htmlspecialchars($row['message']); ?></td>
                    <td><?php echo htmlspecialchars($row['reg_date']); ?></td>
                    <td>
                        <a class="action-button" href="view_contacts.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this submission?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Include Bootstrap Icons JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.js"></script>
</body>
</html>
