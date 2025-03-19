<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$file_path = '../data/enrollments.json';
$enrollments = json_decode(file_get_contents($file_path), true) ?: [];

$indexed_enrollments = [];
foreach ($enrollments as $original_index => $enrollment) {
    $indexed_enrollments[$original_index] = $enrollment;
}

$indexed_enrollments = array_reverse($indexed_enrollments, true);

$filter = $_GET['filter'] ?? 'all';
if ($filter !== 'all') {
    $indexed_enrollments = array_filter($indexed_enrollments, function ($enrollment) use ($filter) {
        return isset($enrollment['status']) && $enrollment['status'] === ucfirst($filter);
    });
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/admin-enrollment.css">

    <title>Enrollment Applications</title>

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
            <h1>Enrollment Applications</h1>
            <form method="GET">
                <label for="filter">Filter by Status:</label>
                <select name="filter" id="filter" onchange="this.form.submit()">
                    <option value="all" <?php echo ($filter === 'all') ? 'selected' : ''; ?>>All</option>
                    <option value="pending" <?php echo ($filter === 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="approved" <?php echo ($filter === 'approved') ? 'selected' : ''; ?>>Approved</option>
                    <option value="rejected" <?php echo ($filter === 'rejected') ? 'selected' : ''; ?>>Rejected</option>
                </select>
            </form>

            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Birthdate</th>
                    <th>Gender</th>
                    <th>Grade</th>
                    <th>Parent Name</th>
                    <th>Contact</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                <?php if (empty($indexed_enrollments)): ?>
                    <tr><td colspan="8">No enrollment applications found.</td></tr>
                <?php else: ?>
                    <?php foreach ($indexed_enrollments as $original_index => $enrollment): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($enrollment['student_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($enrollment['birthdate'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($enrollment['gender'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($enrollment['grade'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($enrollment['parent_name'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($enrollment['parent_contact'] ?? ''); ?></td>
                            <td><?php echo htmlspecialchars($enrollment['status'] ?? 'Pending'); ?></td>
                            <td>
                                <div class="action-menu">
                                    <button class="menu-toggle">...</button>
                                    <div class="menu-dropdown">
                                        <a href="view_enrollment.php?view=<?php echo $original_index; ?>">View</a>
                                        <a href="edit_enrollment.php?edit=<?php echo $original_index; ?>">Edit</a>
                                        <a href="delete_enrollment.php?delete=<?php echo $original_index; ?>" 
                                        class="delete-btn" 
                                        data-id="<?php echo $original_index; ?>">
                                        Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

            <a href="dashboard.php" class="back">Back to Dashboard</a>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(".delete-btn").click(function(e) {
            e.preventDefault();
            let row = $(this).closest("tr");
            let deleteId = $(this).data("id");

            if (confirm("Are you sure you want to delete this enrollment?")) {
                $.ajax({
                    url: "delete_enrollment.php",
                    type: "POST",
                    data: { delete: deleteId },
                    success: function(response) {
                        if (response.trim() === "success") {
                            row.fadeOut(500, function() {
                                $(this).remove();
                            });
                            showToast("Enrollment deleted successfully!");
                        } else {
                            alert("Error deleting the enrollment.");
                        }
                    }
                });
            }
        });

        function showToast(message) {
            let toast = $("<div>").addClass("toast-message").text(message);
            $("body").append(toast);
            setTimeout(() => { toast.fadeOut(500, function() { $(this).remove(); }); }, 2000);
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".menu-toggle").forEach(button => {
                button.addEventListener("click", function() {
                    let dropdown = this.nextElementSibling;
                    dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
                });
            });

            document.addEventListener("click", function(event) {
                if (!event.target.matches(".menu-toggle")) {
                    document.querySelectorAll(".menu-dropdown").forEach(menu => {
                        menu.style.display = "none";
                    });
                }
            });
        });
    </script>

</body>
</html>
