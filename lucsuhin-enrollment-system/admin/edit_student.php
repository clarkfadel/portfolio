<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$students_path = '../data/students.json';
$sections_path = '../data/sections.json';
$students = json_decode(file_get_contents($students_path), true) ?: [];
$sections = json_decode(file_get_contents($sections_path), true) ?: [];

$student_id = $_GET['edit'] ?? '';
$student_index = array_search($student_id, array_column($students, 'student_id'));

if ($student_index === false) {
    die("Student not found.");
}

$student = $students[$student_index];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $students[$student_index]['student_name'] = $_POST['student_name'];
    $students[$student_index]['birthdate'] = $_POST['birthdate'];
    $students[$student_index]['gender'] = $_POST['gender'];
    $students[$student_index]['grade'] = $_POST['grade'];
    $students[$student_index]['guardian_name'] = $_POST['guardian_name'];
    $students[$student_index]['section'] = $_POST['section'] ?? 'N/A';
    
    file_put_contents($students_path, json_encode($students, JSON_PRETTY_PRINT));
    header("Location: manage_students.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/edit-student.css">
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
        <div class="student">
            <h1>Edit Student Data</h1>
            <form method="POST">
                <div class="student-content">
                    <div>
                        <label>Student Name:</label>
                        <input type="text" name="student_name" value="<?php echo htmlspecialchars($student['student_name']); ?>" required>
                    </div>

                    <div>
                        <label>Birthdate:</label>
                        <input type="date" name="birthdate" value="<?php echo htmlspecialchars($student['birthdate']); ?>" required>
                    </div>

                    <div>
                        <label>Gender:</label>
                        <select name="gender" required>
                            <option value="Male" <?php echo ($student['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo ($student['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>

                    <div>
                        <label>Grade:</label>
                        <input type="number" name="grade" min="1" max="6" value="<?php echo htmlspecialchars($student['grade']); ?>" required>
                    </div>
                </div>

                <div class="student-content">
                    <div>
                        <label>Parent/Guardian Name:</label>
                        <input type="text" name="guardian_name" value="<?php echo htmlspecialchars($student['parent_name'] ?? ''); ?>" required>
                    </div>

                    <div>
                        <label>Section:</label>
                        <select name="section">
                            <option value="N/A">N/A</option>
                            <?php foreach ($sections as $section): ?>
                                <option value="<?php echo htmlspecialchars($section['name']); ?>" <?php echo ($student['section'] ?? 'N/A') == $section['name'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($section['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <button type="submit">Update Student</button>
            </form>
            <a href="manage_students.php">Back to Students</a>
        </div>
    </section>
</body>
</html>
