<?php
session_start();
if (!isset($_SESSION['parent'])) {
    header("Location: login.php");
    exit;
}

$parent_email = $_SESSION['parent'];
$enrollments = json_decode(file_get_contents('../data/enrollments.json'), true) ?: [];
$sections = json_decode(file_get_contents('../data/sections.json'), true) ?: [];

$student_sections = [];
foreach ($sections as $section) {
    foreach ($section['students'] as $student_id) {
        $student_sections[$student_id] = $section['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/profile.css">
    <title>Enrollment Status</title>
</head>
<body>
    <nav>
        <div class="nav-bar">
            <div class="nav-logo">
                <a href="../index.php">Lucsuhin Elementary School</a>
            </div>
            <div class="nav-links">
                <ul class="nav-ul">
                    <li><a href="enrollment.php">Enrollment</a></li>
                    <li><a href="enrollment_status.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="profile">
            <h1>Profile</h1>
            <div class="profile-table">
                <table>
                    <h2>Enrollment Status</h2>
                    <tr>
                        <th>Student Name</th>
                        <th>Status</th>
                        <th>Student ID</th>
                        <th>Section</th>
                    </tr>
                    <?php foreach ($enrollments as $enrollment): ?>
                        <?php if ($enrollment['parent_email'] === $parent_email): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($enrollment['student_name']); ?></td>
                                <td><?php echo htmlspecialchars($enrollment['status']); ?></td>
                                <td>
                                    <?php 
                                    echo ($enrollment['status'] === 'Approved') 
                                        ? htmlspecialchars($enrollment['student_id'] ?? 'Pending ID') 
                                        : 'N/A'; 
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                    echo ($enrollment['status'] === 'Approved') 
                                        ? htmlspecialchars($student_sections[$enrollment['student_id']] ?? 'Not Assigned') 
                                        : 'N/A'; 
                                    ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
                <a href="logout.php" class="logout">Logout</a>
            </div>
        </div>
    </section>
</body>
</html>
