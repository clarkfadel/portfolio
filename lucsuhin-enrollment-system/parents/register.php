<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];

    $file_path = '../data/parents.json';

    if (!file_exists($file_path) || filesize($file_path) == 0) {
        file_put_contents($file_path, json_encode([]));
    }

    $json_data = file_get_contents($file_path);
    $users = json_decode($json_data, true);

    if (!is_array($users)) {
        $users = [];
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            echo "Email already registered.";
            exit;
        }
    }

    $users[] = ['email' => $email, 'password' => $password, 'name' => $name];
    file_put_contents($file_path, json_encode($users, JSON_PRETTY_PRINT));

    echo "Registration successful. <a href='login.php'>Login here</a>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Sign Up</title>
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
        <div class="signup">
            <h1>Sign Up</h1>
            <form method="POST">
                <input type="text" name="name" placeholder="Full Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>
    </section>
</body>
</html>
