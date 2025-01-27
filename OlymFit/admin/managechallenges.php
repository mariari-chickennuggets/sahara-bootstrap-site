<?php
session_start();
include '../connect.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit;
}

try {
    $sql = "SELECT id, name, description, start_date, end_date FROM challenges";
    $stmt = $conn->query($sql);
    $challenges = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: []; 
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $challenges = []; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_challenge'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];

    try {
        $sql = "INSERT INTO challenges (name, description, start_date, end_date) 
                VALUES (:name, :description, :start_date, :end_date)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':description' => $description,
            ':start_date' => $startDate,
            ':end_date' => $endDate
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
    <link rel="icon" href="icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif; background-color: #f8f9fa;">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Manage Challenges</h1>

        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <h2>Add a New Challenge</h2>
        <form action="manage_challenges.php" method="POST" class="mb-4">
            <div class="mb-3">
                <label for="name" class="form-label">Challenge Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea id="description" name="description" class="form-control" required></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" required>
                </div>
            </div>
            <button type="submit" name="add_challenge" class="btn btn-success w-100">Add Challenge</button>
        </form>

        <h2 class="mt-4">Existing Challenges</h2>
        <table class="table table-bordered mt-3">
            <thead class="table-dark">
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
                <?php if (!empty($challenges)): ?>
                    <?php foreach ($challenges as $challenge): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($challenge['id']); ?></td>
                            <td><?php echo htmlspecialchars($challenge['name']); ?></td>
                            <td><?php echo htmlspecialchars($challenge['description']); ?></td>
                            <td><?php echo htmlspecialchars($challenge['start_date']); ?></td>
                            <td><?php echo htmlspecialchars($challenge['end_date']); ?></td>
                            <td>
                                <a href="manage_challenges.php?delete=<?php echo htmlspecialchars($challenge['id']); ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Are you sure you want to delete this challenge?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">No challenges found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <a href="dashboard.php" class="btn btn-primary mb-3">Back to Dashboard</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
