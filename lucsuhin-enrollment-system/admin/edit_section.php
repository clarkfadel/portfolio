<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$sections_path = '../data/sections.json';
$students_path = '../data/students.json';

$sections = json_decode(file_get_contents($sections_path), true) ?: [];
$students = json_decode(file_get_contents($students_path), true) ?: [];

if (!isset($_GET['id'])) {
    die("Invalid section ID.");
}

$section_id = $_GET['id'];
$section_index = array_search($section_id, array_column($sections, 'section_id'));

if ($section_index === false) {
    die("Section not found.");
}

$section = $sections[$section_index];
$section_grade = $section['grade_level'];

$assigned_students = array_filter($students, function ($student) use ($section) {
    return isset($student['section']) && $student['section'] === $section['name'];
});

$unassigned_students = array_filter($students, function ($student) use ($sections, $section_grade) {
    return (!isset($student['section']) || $student['section'] === 'N/A') && $student['grade'] === $section_grade;
});

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section['name'] = trim($_POST['section_name']);
    $section['max_students'] = intval($_POST['max_students']);
    
    $manual_students = $_POST['student_ids'] ?? [];

    if (empty($manual_students)) {
        $available_students = array_column($unassigned_students, 'student_id');
        shuffle($available_students);
        $manual_students = array_slice($available_students, 0, $section['max_students']);
    }

    $section['students'] = array_slice($manual_students, 0, $section['max_students']);
    
    foreach ($students as &$student) {
        if (in_array($student['student_id'], $section['students'])) {
            $student['section'] = $section['name'];
        }
    }

    $sections[$section_index] = $section;
    file_put_contents($sections_path, json_encode($sections, JSON_PRETTY_PRINT));
    file_put_contents($students_path, json_encode($students, JSON_PRETTY_PRINT));

    header("Location: class_sections.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Students</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/edit-section.css">
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
        <div class="sections">
            <h1>Edit Class Section</h1>

            <form method="POST">
                <div class="sections-content">
                    <div>
                        <label>Section Name:</label>
                        <input type="text" name="section_name" value="<?php echo htmlspecialchars($section['name']); ?>" required><br>
                    </div>

                    <div>
                    <label>Grade Level:</label>
                    <input type="text" value="<?php echo htmlspecialchars($section['grade_level']); ?>" disabled><br>
                    </div>

                    <div>
                        <label>Max Students:</label>
                        <input type="number" name="max_students" value="<?php echo $section['max_students']; ?>" required><br>
                    </div>
                </div>

                <h3>Current Students in this Section:</h3>
                <?php if (!empty($assigned_students)): ?>
                    <table border="1">
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                        </tr>
                        <?php foreach ($assigned_students as $student): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                <td><?php echo htmlspecialchars($student['student_name']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php else: ?>
                    <p>No students assigned to this section yet.</p>
                <?php endif; ?>

                <h3>Assign New Students:</h3>
                <small>Select students or leave blank to auto-fill.</small>
                <div>
                    <?php if (!empty($unassigned_students)): ?>
                        <?php foreach ($unassigned_students as $student): ?>
                            <input type="checkbox" name="student_ids[]" value="<?php echo $student['student_id']; ?>"
                                <?php echo in_array($student['student_id'], $section['students']) ? 'checked' : ''; ?>>
                            <?php echo htmlspecialchars($student['student_name']) . " (ID: " . $student['student_id'] . ")"; ?>
                            <br>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>No available students for this grade level.</p>
                    <?php endif; ?>
                </div>

                <br>
                <button type="submit">Update Section</button>
            </form>
            <br>
            <a href="class_sections.php" class="back">Back to Sections</a>
        </div>
    </section>

</body>
</html>
