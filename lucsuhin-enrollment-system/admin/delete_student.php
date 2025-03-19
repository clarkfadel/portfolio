<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$students_path = '../data/students.json';
$students = json_decode(file_get_contents($students_path), true) ?: [];

if (isset($_GET['delete'])) {
    $student_id = $_GET['delete'];

    $students = array_filter($students, function ($student) use ($student_id) {
        return $student['student_id'] !== $student_id;
    });

    file_put_contents($students_path, json_encode(array_values($students), JSON_PRETTY_PRINT));

    header("Location: manage_students.php");
    exit;
}
?>
