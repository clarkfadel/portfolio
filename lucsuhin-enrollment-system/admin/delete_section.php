<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$sections_path = '../data/sections.json';
$sections = json_decode(file_get_contents($sections_path), true) ?: [];

if (!isset($_GET['id'])) {
    die("Invalid section ID.");
}

$section_id = $_GET['id'];
$sections = array_filter($sections, function ($section) use ($section_id) {
    return $section['section_id'] !== $section_id;
});

file_put_contents($sections_path, json_encode(array_values($sections), JSON_PRETTY_PRINT));
header("Location: class_sections.php");
exit;
?>
