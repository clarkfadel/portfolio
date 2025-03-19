<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Dashboard</title>
</head>
<body>
    <nav>
        <div class="nav-bar">
            <div class="nav-logo">
                <a href="../index.php">Lucsuhin Elementary School</a>
            </div>
        </div>
    </nav>

    <section>
        <div class="dashboard">
            <ul>
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="enrollment_applications.php">Enrollment</a></li>
                <li><a href="manage_students.php">Students</a></li>
                <li><a href="class_sections.php">Sections</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </section>
</body>
</html>
