<?php
session_start();
include '../db/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Use bcrypt for better security in production

    $stmt = $conn->prepare("SELECT * FROM administrator WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['loggedin'] = true;
        $_SESSION['role'] = 'administrator'; // Add role to session
        header("Location: create.php"); // Redirect to create page
        exit;
    } else {
        $error = "Username or password is incorrect!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Administrator</h2>
            <form method="POST" action="login.php">
                <div class="input-box">
                    <input type="text" name="username" required>
                    <label>Username</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <p class="register-link"><a href="/pages/home.php">Back Home</a></p>
            </form>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
