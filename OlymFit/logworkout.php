<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'connect.php';
?>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; 
    $activity = $_POST['activity'];
    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $distance = $_POST['distance'];
    $calories = $_POST['calories'];
    $intensity = $_POST['intensity'];
    $heartRate = $_POST['heartRate'];
    $location = $_POST['location'];
    $notes = $_POST['notes'];

    try {
        $sql = "INSERT INTO workouts (userId, activity, date, duration, distance, calories, intensity, heartRate, location, notes)
                VALUES (:userId, :activity, :date, :duration, :distance, :calories, :intensity, :heartRate, :location, :notes)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':userId' => $userId,
            ':activity' => $activity,
            ':date' => $date,
            ':duration' => $duration,
            ':distance' => $distance,
            ':calories' => $calories,
            ':intensity' => $intensity,
            ':heartRate' => $heartRate,
            ':location' => $location,
            ':notes' => $notes,
        ]);

        header("Location: workoutDashboard.php?success=1");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

header("Location: workoutDashboard.php?success=1");
exit;

?>
