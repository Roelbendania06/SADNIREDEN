<?php
session_start();
include "db.php";

$message = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $row['username'];
            header("Location: admin_dashboard.php");
            exit;
        } else {
            $message = "Incorrect password.";
        }
    } else {
        $message = "Username not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login - Cheyenne Bakery Supply</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(rgba(146, 92, 43, 0.6), rgba(65, 34, 14, 0.6)),
                        url('https://images.unsplash.com/photo-1542838776-096d3a01381a?auto=format&fit=crop&w=1200&q=80') 
                        no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .login-card {
            width: 420px;
            padding: 40px;
            border-radius: 15px;
            backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.4);
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .brand-title {
            font-size: 30px;
            font-weight: 700;
            text-align: center;
            color: #fff;
            margin-bottom: 10px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .login-title {
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            color: #f5f5f5;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
        }

        .btn-login {
            background: #b5651d;
            color: white;
            font-size: 18px;
            font-weight: 600;
            border-radius: 8px;
            height: 48px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background: #8d4c13;
            transform: scale(1.03);
        }

        a {
            color: #ffd9b3;
        }

        a:hover {
            color: white;
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="login-card">
    <div class="brand-title">Cheyenne Bakery Supply</div>
    <div class="login-title">Admin Login</div>

    <?php if ($message != ""): ?>
        <div class="alert alert-danger text-center"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="text-light">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
        </div>

        <div class="mb-3">
            <label class="text-light">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <button type="submit" name="login" class="btn btn-login w-100">Login</button>

        <div class="text-center mt-2">
            <a href="admin_setup.php">Create admin account</a>
        </div>
    </form>
</div>

</body>
</html>
