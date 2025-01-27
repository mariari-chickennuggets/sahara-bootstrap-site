<?php
include 'db.php';
session_start();

if (isset($_GET['success']) && $_GET['success'] == 1): ?>
    <div class="alert alert-success">
        Workout logged successfully!
    </div>
<?php endif;

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
    $sql = "SELECT * FROM workouts WHERE userId = :userId ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':userId' => $userId]);
    $workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Handle the case where userId is not set in the session
    $workouts = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #d4af37;
            border: none;
        }

        .btn-primary:hover {
            background-color: #c2992b;
        }

        .chart-container {
            margin: 30px auto;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Workout Dashboard</h2>

        <!-- Log Workout Form -->
        <div class="card p-4 mb-5">
            <h4 class="mb-3">Log a New Workout</h4>
            <form action="logWorkout.php" method="POST">
                <div class="mb-3">
                    <label for="activity" class="form-label">Activity</label>
                    <select id="activity" name="activity" class="form-select" required>
                        <option value="Running">Running</option>
                        <option value="Swimming">Swimming</option>
                        <option value="Cycling">Cycling</option>
                        <option value="Weightlifting">Weightlifting</option>
                        <option value="Yoga">Yoga</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="duration" class="form-label">Duration (minutes)</label>
                        <input type="number" id="duration" name="duration" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="distance" class="form-label">Distance (km)</label>
                        <input type="number" step="0.01" id="distance" name="distance" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="calories" class="form-label">Calories Burned</label>
                        <input type="number" id="calories" name="calories" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="intensity" class="form-label">Intensity</label>
                    <select id="intensity" name="intensity" class="form-select">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="heartRate" class="form-label">Average Heart Rate</label>
                    <input type="number" id="heartRate" name="heartRate" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="location" class="form-label">Location</label>
                    <input type="text" id="location" name="location" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea id="notes" name="notes" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Log Workout</button>
            </form>
        </div>

        <!-- Workouts List -->
        <div class="card p-4">
            <h4 class="mb-3">Workout History</h4>
            <ul class="list-group">
                <?php foreach ($workouts as $workout): ?>
                    <li class="list-group-item">
                        <strong><?= htmlspecialchars($workout['activity']) ?></strong> on
                        <?= htmlspecialchars($workout['date']) ?> -
                        <?= htmlspecialchars($workout['duration']) ?> mins, <?= htmlspecialchars($workout['distance']) ?>
                        km,
                        <?= htmlspecialchars($workout['calories']) ?> cal
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</body>

</html>