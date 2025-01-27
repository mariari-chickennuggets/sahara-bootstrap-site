<?php
include 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['userId'] = $user['id'];
            $_SESSION['userName'] = $user['name'];
            header("Location: dashboard.php"); 
            exit;
        } else {
            $error = "Invalid email or password!";
        }
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="icon" href="icon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .navbar {
            background-color: #000000;
            padding: 1rem 1.5rem;
        }
        .navbar-brand {
            font-weight: 600;
            color: #fff;
        }
        .btn-primary {
            background-color: #005eb8;
            border: none;
            border-radius: 25px;
            padding: 0.75rem 1.5rem;
        }
        .btn-primary:hover {
            background-color: #003c78;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem;
        }
        .form-section {
            padding: 2rem 1rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        footer {
            background-color: #000000;
            color: white;
            padding: 20px 0;
            margin-top: 2rem;
            text-align: center;
        }
        @media (min-width: 768px) {
            .form-section {
                padding: 3rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">OlymFit</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="form-section mx-auto" style="max-width: 500px;">
            <h1 class="text-center mb-4">Login</h1>
            <form action="login.php" method="POST">
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
            </form>
            <div class="text-center mt-3">
                <a href="register.php" class="text-decoration-none">Create an account</a>
            </div>
            <?php if (isset($error)) { echo "<div class='alert alert-danger mt-4'>$error</div>"; } ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2025 OlyFit. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
