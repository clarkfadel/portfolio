<?php
session_start();
if (!isset($_SESSION['parent'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_name = $_POST['student_name'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $grade = $_POST['grade'];
    $parent_email = $_SESSION['parent'];
    $parent_name = $_POST['parent_name'];
    $parent_contact = $_POST['parent_contact'];

    $upload_dir = '../data/uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_path = '';
    if (!empty($_FILES['attachment']['name'])) { 
        $file_name = time() . '_' . basename($_FILES['attachment']['name']);
        $file_path = $upload_dir . $file_name;
        move_uploaded_file($_FILES['attachment']['tmp_name'], $file_path);
    }


    $file_path_enrollments = '../data/enrollments.json';
    if (!file_exists($file_path_enrollments) || filesize($file_path_enrollments) == 0) {
        file_put_contents($file_path_enrollments, json_encode([]));
    }

    $enrollments = json_decode(file_get_contents($file_path_enrollments), true);

    $enrollments[] = [
        'parent_email' => $parent_email,
        'parent_name' => $parent_name,
        'parent_contact' => $parent_contact,
        'student_name' => $student_name,
        'birthdate' => $birthdate,
        'gender' => $gender,
        'address' => $address,
        'grade' => $grade,
        'document' => $file_path,
        'status' => 'Pending'
    ];

    file_put_contents($file_path_enrollments, json_encode($enrollments, JSON_PRETTY_PRINT));

    echo "Enrollment submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/enrollment.css">
    <title>Enrollment</title>
</head>
<body>
    <nav>
        <div class="nav-bar">
            <div class="nav-logo">
                <a href="../index.php">Lucsuhin Elementary School</a>
            </div>
            <div class="nav-links">
                <ul class="nav-ul">
                    <li><a href="enrollment.php">Enrollment</a></li>
                    <li><a href="enrollment_status.php">Profile</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="enrollment">
            <h1>Student Information</h1>
            <form method="POST" enctype="multipart/form-data">
                <div class="enrollment-content">
                    <div>
                        <label for="">Full Name:</label>
                        <input type="text" name="student_name" placeholder="Student Name" required>
                    </div>

                    <div>
                        <label for="">Birthdate:</label>
                        <input type="date" name="birthdate" required>
                    </div>

                    <div>
                        <label for="">Gender:</label>
                        <select name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="grade">Grade:</label>
                        <select name="grade" id="grade" required>
                            <option value="" disabled selected>Select Grade</option>
                            <?php for ($i = 1; $i <= 6; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo "Grade " . $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>

                <div class="enrollment-content">
                    <div class="address">
                        <label for="">Address</label>
                        <input type="text" name="address" placeholder="Home Address" required>
                    </div>
                </div>


                <div class="enrollment-content">
                    <div>
                        <label for="">Parent/Guardian Name</label>
                        <input type="text" name="parent_name" placeholder="Parent/Guardian Name" required>            
                    </div>
                    <div>
                        <label for="">Contact Number</label>
                        <input type="text" name="parent_contact" placeholder="Contact Number" required>
                    </div>
                </div>

                <div>
                    <h2>Birth Certificate</h2>
                    <label for="attachment">Attach File (PDF, JPG, PNG):</label>
                    <input type="file" name="attachment" id="attachment" accept=".pdf,.jpg,.png" required>
                </div>

                <button type="submit">Submit Enrollment</button>
            </form>
        </div>
    </section>
</body>
</html>
