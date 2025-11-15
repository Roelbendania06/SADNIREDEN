<?php
include "db.php"; 

$message = "";

if (isset($_POST['create'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        $message = "Admin account created successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Create Admin - Cheyenne Bakery Supply</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        height: 100vh;
        margin: 0;
        font-family: "Poppins", sans-serif;
        background: linear-gradient(rgba(146, 92, 43, 0.65), rgba(65, 34, 14, 0.65)),
                    url('https://images.unsplash.com/photo-1578976024084-7d19f4e7c4cc?auto=format&fit=crop&w=1200&q=80')
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

    .setup-card {
        width: 430px;
        padding: 35px;
        border-radius: 15px;
        backdrop-filter: blur(15px);
        background: rgba(255, 255, 255, 0.22);
        box-shadow: 0 10px 30px rgba(0,0,0,0.35);
        border: 1px solid rgba(255,255,255,0.4);
        animation: slideUp 0.6s ease;
        text-align: center;
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .title {
        font-size: 26px;
        font-weight: 700;
        color: #fff;
        text-shadow: 1px 1px 3px rgba(0,0,0,0.6);
        margin-bottom: 10px;
    }

    .subtitle {
        font-size: 15px;
        color: #ececec;
        margin-bottom: 25px;
    }

    .form-label {
        color: #fff;
        font-weight: 600;
    }

    .form-control {
        height: 45px;
        border-radius: 8px;
    }

    .btn-create {
        width: 100%;
        height: 48px;
        font-size: 17px;
        font-weight: 600;
        border-radius: 8px;
        background: #b5651d;
        color: white;
        transition: 0.3s;
    }

    .btn-create:hover {
        background: #8a4513;
        transform: scale(1.03);
    }

    a {
        color: #ffd9b3;
        font-weight: 500;
    }

    a:hover {
        color: white;
    }
</style>

</head>
<body>

<div class="setup-card">
    <div class="title">Create Admin Account</div>
    <div class="subtitle">Set up your administrator access</div>

    <?php if ($message != ""): ?>
        <div class="alert alert-info fw-bold"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3 text-start">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Enter username" required>
        </div>

        <div class="mb-3 text-start">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
        </div>

        <button type="submit" name="create" class="btn-create">Create Admin</button>

        <div class="mt-3">
            <a href="admin_login.php">Back to Login</a>
        </div>
    </form>
</div>

</body>
</html>
