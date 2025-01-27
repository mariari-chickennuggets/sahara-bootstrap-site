<?php
session_start();
include '../db.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

// Fetch all challenges
try {
    $sql = "SELECT id, name, description, start_date, end_date FROM challenges";
    $stmt = $conn->query($sql);
    $challenges = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_challenge'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    try {
        $sql = "INSERT INTO challenges (name, description, start_date, end_date) VALUES (:name, :description, :start_date, :end_date)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':start_date' => $start_date,
            ':end_date' => $end_date
        ]);
        $success = "Challenge added successfully!";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        $sql = "DELETE FROM challenges WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $success = "Challenge deleted successfully!";
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
    <title>Manage Challenges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJ4LZ7L6oB8gGpz6a9f6dq8gwmGQRV1pq3Vv9MUP6F2hfwF4X2/5y2Kw/8rj" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1>Manage Challenges</h1>
        <a href="dashboard.php" class="btn btn-primary mb-3">Back to Dashboard</a>

        <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

        <h2>Add a New Challenge</h2>
        <form action="manage_challenges.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Challenge Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
               <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" name="add_challenge" class="btn btn-success w-100">Add Challenge</button>
        </form>

        <h2 class="mt-4">Existing Challenges</h2>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($challenges as $challenge): ?>
                    <tr>
                        <td><?php echo $challenge['id']; ?></td>
                        <td><?php echo htmlspecialchars($challenge['name']); ?></td>
                        <td><?php echo htmlspecialchars($challenge['description']); ?></td>
                        <td><?php echo $challenge['start_date']; ?></td>
                        <td><?php echo $challenge['end_date']; ?></td>
                        <td>
                            <a href="manage_challenges.php?delete=<?php echo $challenge['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this challenge?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0WqF9s0Zdl2rj9W4zIkd6wvVXxN/hgWvkU60Lg4ZoxLr3mM9" crossorigin="anonymous"></script>
</body>
</html>
