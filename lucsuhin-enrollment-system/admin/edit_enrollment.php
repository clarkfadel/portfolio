<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$file_path = '../data/enrollments.json';
$enrollments = json_decode(file_get_contents($file_path), true) ?: [];

if (!isset($_GET['edit']) || !isset($enrollments[$_GET['edit']])) {
    header("Location: enrollment_applications.php");
    exit;
}

$index = (int)$_GET['edit'];
$enrollment = $enrollments[$index];

function get_value($array, $key, $default = '') {
    return isset($array[$key]) ? htmlspecialchars($array[$key]) : $default;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $enrollments[$index]['student_name'] = $_POST['student_name'] ?? '';
    $enrollments[$index]['birthdate'] = $_POST['birthdate'] ?? '';
    $enrollments[$index]['gender'] = $_POST['gender'] ?? '';
    $enrollments[$index]['grade'] = $_POST['grade'] ?? '';
    $enrollments[$index]['parent_name'] = $_POST['parent_name'] ?? '';
    $enrollments[$index]['parent_contact'] = $_POST['parent_contact'] ?? '';
    $enrollments[$index]['status'] = $_POST['status'] ?? 'Pending';

    file_put_contents($file_path, json_encode($enrollments, JSON_PRETTY_PRINT));
    header("Location: enrollment_applications.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/edit-enrollment.css">

    <title>Edit Enrollment Applications</title>

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
        <div class="enrollment">
            <h1>Edit Enrollment Application</h1>
            <form method="POST">
                <div class="enrollment-content">
                    <div>
                        <label>Student Name:</label>
                        <input type="text" name="student_name" value="<?php echo get_value($enrollment, 'student_name'); ?>" required>
                    </div>

                    <div>
                        <label>Birthdate:</label>
                        <input type="date" name="birthdate" value="<?php echo get_value($enrollment, 'birthdate'); ?>" required>
                    </div>

                    <div>
                        <label>Gender:</label>
                        <select name="gender" required>
                            <option value="Male" <?php echo (get_value($enrollment, 'gender') == 'Male') ? 'selected' : ''; ?>>Male</option>
                            <option value="Female" <?php echo (get_value($enrollment, 'gender') == 'Female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>

                    <div>
                        <label>Grade:</label>
                        <input type="number" name="grade" value="<?php echo get_value($enrollment, 'grade'); ?>" required>
                    </div>
                </div>

                <div class="enrollment-content">
                    <div>
                        <label>Parent Name:</label>
                        <input type="text" name="parent_name" value="<?php echo get_value($enrollment, 'parent_name'); ?>" required>
                    </div>

                    <div>
                        <label>Parent Contact:</label>
                        <input type="text" name="parent_contact" value="<?php echo get_value($enrollment, 'parent_contact'); ?>" required>
                    </div>

                    <div>
                        <label>Status:</label>
                        <select name="status" required>
                            <option value="Pending" <?php echo (get_value($enrollment, 'status') == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                            <option value="Approved" <?php echo (get_value($enrollment, 'status') == 'Approved') ? 'selected' : ''; ?>>Approved</option>
                            <option value="Rejected" <?php echo (get_value($enrollment, 'status') == 'Rejected') ? 'selected' : ''; ?>>Rejected</option>
                        </select>
                    </div>
                </div>

                <button type="submit">Save Changes</button>
            </form>
            <a href="enrollment_applications.php">Back to Enrollment Applications</a>
        </div>
    </section>

