<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$students_path = '../data/students.json';
$sections_path = '../data/sections.json';
$enrollments_path = '../data/enrollments.json';

$students = json_decode(file_get_contents($students_path), true) ?: [];
$sections = json_decode(file_get_contents($sections_path), true) ?: [];
$enrollments = json_decode(file_get_contents($enrollments_path), true) ?: [];

$student_sections = [];
foreach ($sections as $section) {
    foreach ($section['students'] as $student_id) {
        $student_sections[$student_id] = $section['name'];
    }
}

foreach ($students as &$student) {
    if (isset($student['student_id'])) {
        $student_id = $student['student_id'];
        $student['section'] = $student_sections[$student_id] ?? 'N/A'; 
    }
}
unset($student);

file_put_contents($students_path, json_encode($students, JSON_PRETTY_PRINT));

$search_query = $_GET['search'] ?? '';
if ($search_query !== '') {
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
