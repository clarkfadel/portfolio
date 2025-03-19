<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$sections_path = '../data/sections.json';
$sections = json_decode(file_get_contents($sections_path), true) ?: [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sections.css">

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
        <div class="section">
            <h1>Manage Class Sections</h1>
            <a href="create_section.php" class="create">Create New Section</a>
            <br><br>
            
            <table border="1">
                <tr>
                    <th>Section Name</th>
                    <th>Max Students</th>
                    <th>Current Students</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($sections as $section): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($section['name']); ?></td>
                        <td><?php echo htmlspecialchars($section['max_students']); ?></td>
                        <td><?php echo count($section['students']); ?></td>
                        <td>
                            <div class="action-menu">
                                <button class="menu-toggle">...</button>
                                <div class="menu-dropdown">
                                    <a href="edit_section.php?id=<?php echo urlencode($section['section_id']); ?>">Edit</a>
                                    <a href="delete_section.php?id=<?php echo urlencode($section['section_id']); ?>" onclick="return confirm('Are you sure you want to delete this section?');">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            
            <br>
            <a href="dashboard.php" class="back"><- Back to Dashboard</a>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
