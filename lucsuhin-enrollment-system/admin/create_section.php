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

$assigned_student_ids = [];
foreach ($sections as $section) {
    $assigned_student_ids = array_merge($assigned_student_ids, $section['students']);
}

if (isset($_GET['ajax']) && $_GET['ajax'] == 1) {
    $search_query = $_GET['search'] ?? '';
    $grade_filter = $_GET['grade'] ?? '';

    $filtered_students = array_filter($students, function ($student) use ($search_query, $grade_filter, $assigned_student_ids) {
        if (in_array($student['student_id'], $assigned_student_ids)) {
            return false; 
        }
        if ($grade_filter && $student['grade'] !== $grade_filter) {
            return false; 
        }
        return stripos($student['student_name'], $search_query) !== false || 
               stripos($student['student_id'], $search_query) !== false;
    });

    echo json_encode(array_values($filtered_students));
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_section'])) {
    $section_name = trim($_POST['section_name']);
    $max_students = intval($_POST['max_students']);
    $grade_level = $_POST['grade_level'] ?? '';
    $selected_students = $_POST['student_ids'] ?? [];

    $valid_students = [];
    foreach ($students as $student) {
        if (in_array($student['student_id'], $selected_students) && $student['grade'] === $grade_level) {
            $valid_students[] = $student['student_id'];
        }
    }

    $valid_students = array_slice($valid_students, 0, $max_students);

    $new_section = [
        'section_id' => uniqid(),
        'name' => $section_name,
        'grade_level' => $grade_level,
        'max_students' => $max_students,
        'students' => $valid_students 
    ];

    $sections[] = $new_section;

    file_put_contents($sections_path, json_encode($sections, JSON_PRETTY_PRINT));
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
    <link rel="stylesheet" href="../css/create-section.css">
    
    <title>Create Section</title>
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
            <h1>Create Class Section</h1>

            <form method="POST">
                <div class="sections-content">
                    <div>
                        <label>Section Name:</label><br>
                        <input type="text" name="section_name" required>
                    </div>

                    <div>
                        <label>Grade Level:</label><br>
                        <select id="grade_level" name="grade_level" required>
                            <option value="">Select Grade</option>
                            <?php
                            $grade_levels = array_unique(array_column($students, 'grade'));
                            sort($grade_levels);
                            foreach ($grade_levels as $grade) {
                                echo "<option value=\"$grade\">$grade</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div>
                        <label>Max Students:</label><br>
                        <input type="number" id="max_students" name="max_students" required>
                    </div>
                </div>

                <h2>Search Students:</h2>
                <input type="text" id="search" placeholder="Search by Name or ID">

                <div class="sections-table">
                    <h3>Available Students</h3>
                    <table>
                        <tr>
                            <th>Select</th>
                            <th>Student Name</th>
                            <th>Student ID</th>
                            <th>Grade</th>
                        </tr>
                        <tbody id="students_table">
                            <?php foreach ($students as $student): ?>
                                <?php if (!in_array($student['student_id'], $assigned_student_ids)) : ?>
                                    <tr>
                                        <td><input type="checkbox" name="student_ids[]" value="<?php echo htmlspecialchars($student['student_id']); ?>"></td>
                                        <td><?php echo htmlspecialchars($student['student_name']); ?></td>
                                        <td><?php echo htmlspecialchars($student['student_id']); ?></td>
                                        <td><?php echo htmlspecialchars($student['grade']); ?></td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <br>
                <button type="button" onclick="fillSection()">Fill Section</button>
                <button type="submit" name="create_section">Create Section</button>
            </form>

            <br>
            <a href="class_sections.php" class="back">Back to Sections</a>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("grade_level").addEventListener("change", updateStudentList);
            document.getElementById("search").addEventListener("input", updateStudentList);
        });

        function updateStudentList() {
            let searchQuery = document.getElementById("search").value;
            let gradeFilter = document.getElementById("grade_level").value;

            fetch(`create_section.php?ajax=1&search=${encodeURIComponent(searchQuery)}&grade=${encodeURIComponent(gradeFilter)}`)
                .then(response => response.json())
                .then(data => {
                    let tableBody = document.getElementById("students_table");
                    tableBody.innerHTML = "";

                    data.forEach(student => {
                        let row = `<tr>
                            <td><input type="checkbox" name="student_ids[]" value="${student.student_id}"></td>
                            <td>${student.student_name}</td>
                            <td>${student.student_id}</td>
                            <td>${student.grade}</td>
                        </tr>`;
                        tableBody.innerHTML += row;
                    });
                });
        }

        function fillSection() {
            let checkboxes = document.querySelectorAll('input[name="student_ids[]"]');
            let maxStudents = parseInt(document.getElementById("max_students").value) || 0;
            let count = 0;

            checkboxes.forEach(checkbox => {
                if (count < maxStudents) {
                    checkbox.checked = true;
                    count++;
                } else {
                    checkbox.checked = false;
                }
            });
        }
    </script>
</body>
</html>
