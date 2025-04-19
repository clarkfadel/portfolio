<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$file_path = '../data/enrollments.json';
$students_path = '../data/students.json';
$enrollments = json_decode(file_get_contents($file_path), true) ?: [];
$students = json_decode(file_get_contents($students_path), true) ?: [];

$existing_student_ids = array_column($students, 'student_id');
$existing_student_names = array_column($students, 'student_name'); 

$enrollments_updated = false;

foreach ($enrollments as &$enrollment) {
    if ($enrollment['status'] === 'Approved') {
        if (!isset($enrollment['student_id'])) {
            $enrollment['student_id'] = date('Y') . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $enrollment['section'] = 'N/A'; 
            $enrollments_updated = true;
        }

        if (!in_array($enrollment['student_id'], $existing_student_ids) && !in_array($enrollment['student_name'], $existing_student_names)) {
            $students[] = $enrollment;
        }
    }
}

if ($enrollments_updated) {
    file_put_contents($file_path, json_encode($enrollments, JSON_PRETTY_PRINT));
}

file_put_contents($students_path, json_encode($students, JSON_PRETTY_PRINT));

$search_query = isset($_GET['search']) ? trim($_GET['search']) : '';

if (!empty($search_query)) {
    $students = array_filter($students, function ($student) use ($search_query) {
        return stripos($student['student_id'], $search_query) !== false || 
               stripos($student['student_name'], $search_query) !== false;
    });
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/manage-section.css">
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
        <div class="students">
            <h1>Manage Students</h1>
            <form method="GET">
                <input type="text" name="search" placeholder="Search by Student ID or Name" value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <br>
            
            <table border="1">
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Grade</th>
                    <th>Guardian Name</th>
                    <th>Section</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($student['student_id'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($student['student_name'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($student['birthdate'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($student['gender'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($student['grade'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($student['parent_name'] ?? ''); ?></td>
                        <td><?php echo htmlspecialchars($student['section'] ?? 'N/A'); ?></td>
                        <td>
                            <div class="action-menu">
                                <button class="menu-toggle">...</button>
                                <div class="menu-dropdown">
                                    <a href="view_student.php?id=<?php echo $student['student_id']; ?>">View</a>
                                    <a href="edit_student.php?edit=<?php echo $student['student_id']; ?>">Edit</a>
                                    <a href="delete_student.php?delete=<?php echo $student['student_id']; ?>" onclick="return confirm('Are you sure?');">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <a href="dashboard.php" class="back">Back to Dashboard</a>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/0a27fbe28a.js" crossorigin="anonymous"></script>                
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".menu-toggle").forEach(button => {
                button.addEventListener("click", function() {
                    let dropdown = this.nextElementSibling;
                    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
                });
            });

            document.addEventListener("click", function(event) {
                if (!event.target.matches(".menu-toggle")) {
                    document.querySelectorAll(".menu-dropdown").forEach(menu => {
                        menu.style.display = "none";
                    });
                }
            });
        });
    </script>
</body>
</html>
