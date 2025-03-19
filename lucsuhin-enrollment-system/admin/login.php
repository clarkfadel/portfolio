<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_email = "admin@example.com";
    $admin_password = "admin123";

    if ($_POST['email'] === $admin_email && $_POST['password'] === $admin_password) {
        $_SESSION['admin'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid admin credentials.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
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
        <div class="login">
            <h1>Admin Login</h1>
            <form method="POST">
                <input type="email" name="email" placeholder="Admin Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </section>
</body>
</html>
