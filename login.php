<?php
session_start();
$host = "localhost";
$dbname = "ecommerce";
$user = "root";
$pass = "";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            header("Location: index1.php");
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "User not found.";
    }

    $stmt->close();
    $conn->close();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
    <style>
        body {
            background: #f4f7fa;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background: white;
            padding: 30px;
            border-radius: 10px;
            width: 320px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        h2 {
            margin-bottom: 20px;
            text-align: center;
            color: #34495e;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            width: 100%;
            padding: 12px;
            margin-top: 20px;
            background-color: #2ecc71;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #27ae60;
        }
        .message {
            margin-top: 15px;
            text-align: center;
            color: red;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 12px;
            color: #2980b9;
            text-decoration: none;
        }
    </style>
</head>
<body>

<form method="post" action="">
    <h2>Login</h2>
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit" href="go.php">Login</button>
    <a href="register.php">Don't have an account? Register</a>
    <div class="message">
        <?php if (!empty($message)) echo $message; ?>
    </div>
</form>

</body>
</html>
