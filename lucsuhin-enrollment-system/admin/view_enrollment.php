<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$file_path = '../data/enrollments.json';
$enrollments = json_decode(file_get_contents($file_path), true) ?: [];

if (!isset($_GET['view']) || !is_numeric($_GET['view'])) {
    echo "Invalid enrollment ID.";
    exit;
}

$index = (int) $_GET['view'];
$enrollment = $enrollments[$index] ?? null;

if (!$enrollment) {
    echo "Enrollment not found.";
    exit;
}

$document_path = $enrollment['document'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Enrollment</title>
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
    <h2>Enrollment Details</h2>
    
    <div class="info"><strong>Student Name:</strong> <?php echo htmlspecialchars($enrollment['student_name']); ?></div>
    <div class="info"><strong>Birthdate:</strong> <?php echo htmlspecialchars($enrollment['birthdate']); ?></div>
    <div class="info"><strong>Gender:</strong> <?php echo htmlspecialchars($enrollment['gender']); ?></div>
    <div class="info"><strong>Grade:</strong> <?php echo htmlspecialchars($enrollment['grade']); ?></div>
    <div class="info"><strong>Parent Name:</strong> <?php echo htmlspecialchars($enrollment['parent_name']); ?></div>
    <div class="info"><strong>Parent Contact:</strong> <?php echo htmlspecialchars($enrollment['parent_contact']); ?></div>
    <div class="info"><strong>Status:</strong> <?php echo htmlspecialchars($enrollment['status']); ?></div>

    <?php if (!empty($document_path) && file_exists($document_path)) : ?>
        <div class="info">
            <strong>Attached File:</strong>
            <br>
            <a href="<?php echo $document_path; ?>" class="download-btn" download>📥 Download File</a>
        </div>
    <?php else : ?>
        <div class="info"><strong>Attached File:</strong> No document uploaded.</div>
    <?php endif; ?>

    <div class="back">
        <a href="enrollment_applications.php">⬅ Back to Enrollment List</a>
    </div>
</div>

</body>
</html>
