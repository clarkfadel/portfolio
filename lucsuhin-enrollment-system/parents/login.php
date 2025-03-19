<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $users = json_decode(file_get_contents('../data/parents.json'), true);
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['parent'] = $email;
            header("Location: enrollment.php");
            exit;
        }
    }
    echo "Invalid credentials.";
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
            <div class="nav-links">
                <ul class="nav-ul">
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section>
        <div class="login">
            <h1>Login</h1>
            <form method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <h6>Don't have an account? <span><a href="register.php">Sign Up</a></span></h6>
            </form>
        </div>
    </section>
</body>
</html>
