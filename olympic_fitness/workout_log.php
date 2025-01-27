<?php
// Database connection (replace with your database credentials)
$host = 'localhost';
$dbname = 'fitness_tracker';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['log_workout'])) {
    $activity = $_POST['activity'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $distance = $_POST['distance'];
    $calories = $_POST['calories'];

    $sql = "INSERT INTO workouts (activity, date, duration, distance, calories) VALUES (:activity, :date, :duration, :distance, :calories)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':activity' => $activity,
        ':date' => $date,
        ':duration' => $duration,
        ':distance' => $distance,
        ':calories' => $calories
    ]);

    header("Location: workout_log.php"); // Redirect to avoid form resubmission
    exit;
}

// Fetch workouts
$sql = "SELECT * FROM workouts ORDER BY date DESC";
$workouts = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Handle delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM workouts WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':id' => $id]);

    header("Location: workout_log.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Workout Log</h1>

        <!-- Log Workout Form -->
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="card-title">Log a New Workout</h3>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="activity" class="form-label">Activity</label>
                        <select id="activity" name="activity" class="form-select" required>
                            <option value="Running">Running</option>
                            <option value="Swimming">Swimming</option>
                            <option value="Cycling">Cycling</option>
                            <option value="Walking">Walking</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (minutes)</label>
                        <input type="number" id="duration" name="duration" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="distance" class="form-label">Distance (km)</label>
                        <input type="number" step="0.01" id="distance" name="distance" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="calories" class="form-label">Calories Burned</label>
                        <input type="number" id="calories" name="calories" class="form-control" required>
                    </div>
                    <button type="submit" name="log_workout" class="btn btn-primary">Log Workout</button>
                </form>
            </div>
        </div>

        <!-- Workout History Table -->
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Workout History</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Activity</th>
                            <th>Duration (min)</th>
                            <th>Distance (km)</th>
                            <th>Calories</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($workouts as $workout): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($workout['date']); ?></td>
                                <td><?php echo htmlspecialchars($workout['activity']); ?></td>
                                <td><?php echo htmlspecialchars($workout['duration']); ?></td>
                                <td><?php echo htmlspecialchars($workout['distance']); ?></td>
                                <td><?php echo htmlspecialchars($workout['calories']); ?></td>
                                <td>
                                    <a href="?delete=<?php echo $workout['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this workout?');">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
