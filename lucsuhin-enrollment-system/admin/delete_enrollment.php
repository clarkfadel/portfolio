<?php
session_start();
if (!isset($_SESSION['admin'])) {
    die("Unauthorized");
}

$file_path = '../data/enrollments.json';

if (!file_exists($file_path)) {
    die("Enrollment file not found.");
}

$enrollments = json_decode(file_get_contents($file_path), true) ?: [];

$deleteIndex = $_POST['delete'] ?? $_GET['delete'] ?? null;

if ($deleteIndex !== null) {
    $deleteIndex = intval($deleteIndex);

    if (isset($enrollments[$deleteIndex])) {
        array_splice($enrollments, $deleteIndex, 1);
        file_put_contents($file_path, json_encode($enrollments, JSON_PRETTY_PRINT));
        echo "success";
        exit;
    }
}

echo "error";
?>
