<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="icon.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .navbar {
            background-color: #0056b3;
        }

        .navbar-brand {
            font-weight: 600;
            color: #fff;
        }

        .navbar-brand:hover {
            color: #d4af37;
        }

        .dashboard-container {
            margin-top: 20px;
            padding: 20px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #d4af37;
            border: none;
            border-radius: 25px;
        }

        .btn-primary:hover {
            background-color: #c2992b;
        }

        .dashboard-section {
            margin-bottom: 20px;
        }

        .dashboard-section h4 {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">OlymFit</a>
        </div>
    </nav>

    <div class="container dashboard-container">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="row">
            <div class="col-md-12 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Analytics Overview</h4>
                    <div class="row text-center">
                        <div class="col-sm-3">
                            <h5>Total Users</h5>
                            <p>1,234</p>
                        </div>
                        <div class="col-sm-3">
                            <h5>Active Challenges</h5>
                            <p>12</p>
                        </div>
                        <div class="col-sm-3">
                            <h5>Total Workouts Logged</h5>
                            <p>56,789</p>
                        </div>
                        <div class="col-sm-3">
                            <h5>Total Calories Burned</h5>
                            <p>2,345,678</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Manage Users</h4>
                    <a href="manageusers.php" class="btn btn-primary w-100 mb-3">View All Users</a>
                </div>
            </div>

            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Activity Logs</h4>
                    <a href="logs.html" class="btn btn-primary w-100">View Logs</a>
                </div>
            </div>

            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Manage Challenges</h4>
                    <a href="managechallenges.php" class="btn btn-primary w-100 mb-3">Create New Challenge</a>
                </div>
            </div>

            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Announcements</h4>
                    <a href="create-announcement.html" class="btn btn-primary w-100">Create Announcement</a>
                </div>
            </div>

            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Leaderboard Management</h4>
                    <a href="leaderboard.html" class="btn btn-primary w-100">View Leaderboard</a>
                    <a href="feature-top-users.html" class="btn btn-primary w-100 mt-3">Feature Top Users</a>
                </div>
            </div>

            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">User Feedback & Support</h4>
                    <a href="feedback.html" class="btn btn-primary w-100 mb-3">View Feedback</a>
                    <a href="support-tickets.html" class="btn btn-primary w-100">Manage Support Tickets</a>
                </div>
            </div>

            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Admin Settings</h4>
                    <a href="update-profile.html" class="btn btn-primary w-100 mb-3">Update Profile</a>
                    <a href="add-admin.html" class="btn btn-primary w-100">Add New Admin</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>