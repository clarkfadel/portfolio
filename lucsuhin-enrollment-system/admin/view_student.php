<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$students_path = '../data/students.json';
$students = json_decode(file_get_contents($students_path), true) ?: [];

$student_id = $_GET['id'] ?? '';

$student = null;
foreach ($students as $s) {
    if ($s['student_id'] === $student_id) {
        $student = $s;
        break;
    }
}

if (!$student) {
    die("Invalid student ID.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Student</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        h2 { text-align: center; }
        .info { margin-bottom: 10px; padding: 10px; background: #f9f9f9; border-radius: 5px; }
        .back { text-align: center; margin-top: 20px; }
        .download-btn { display: inline-block; padding: 10px 15px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; }
        .download-btn:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Student Details</h2>
        <div class="info"><strong>Student ID:</strong> <?php echo htmlspecialchars($student['student_id']); ?></div>
        <div class="info"><strong>Name:</strong> <?php echo htmlspecialchars($student['student_name']); ?></div>
        <div class="info"><strong>Birthdate:</strong> <?php echo htmlspecialchars($student['birthdate']); ?></div>
        <div class="info"><strong>Gender:</strong> <?php echo htmlspecialchars($student['gender']); ?></div>
        <div class="info"><strong>Grade:</strong> <?php echo htmlspecialchars($student['grade']); ?></div>
        <div class="info"><strong>Guardian Name:</strong> <?php echo htmlspecialchars($student['parent_name']); ?></div>
        <div class="info"><strong>Section:</strong> <?php echo htmlspecialchars($student['section'] ?? 'N/A'); ?></div>
        <br>
        <div class="back">
            <a href="manage_students.php">⬅ Back to Manage Students</a>
        </div>
    </div>
</body>
</html>
