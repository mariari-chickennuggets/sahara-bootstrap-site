<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Olympic Fitness Challenge Tracker</title>
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Olympic Tracker</a>
        </div>
    </nav>

    <!-- Admin Dashboard -->
    <div class="container dashboard-container">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="row">
            <!-- Analytics Overview -->
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

            <!-- Manage Users -->
            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Manage Users</h4>
                    <button class="btn btn-primary w-100 mb-3">View All Users</button>
                    <button class="btn btn-primary w-100">Add New User</button>
                </div>
            </div>

            <!-- Activity Logs -->
            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Activity Logs</h4>
                    <button class="btn btn-primary w-100">View Logs</button>
                </div>
            </div>

            <!-- Manage Challenges -->
            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Manage Challenges</h4>
                    <button class="btn btn-primary w-100 mb-3">Create New Challenge</button>
                    <button class="btn btn-primary w-100">View Challenges</button>
                </div>
            </div>

            <!-- Notifications & Announcements -->
            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Notifications & Announcements</h4>
                    <button class="btn btn-primary w-100 mb-3">Send Notification</button>
                    <button class="btn btn-primary w-100">Create Announcement</button>
                </div>
            </div>

            <!-- Leaderboard Management -->
            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Leaderboard Management</h4>
                    <button class="btn btn-primary w-100">View Leaderboard</button>
                    <button class="btn btn-primary w-100 mt-3">Feature Top Users</button>
                </div>
            </div>

            <!-- User Feedback & Support -->
            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">User Feedback & Support</h4>
                    <button class="btn btn-primary w-100 mb-3">View Feedback</button>
                    <button class="btn btn-primary w-100">Manage Support Tickets</button>
                </div>
            </div>

            <!-- Admin Settings -->
            <div class="col-md-6 dashboard-section">
                <div class="card p-4">
                    <h4 class="card-title">Admin Settings</h4>
                    <button class="btn btn-primary w-100 mb-3">Update Profile</button>
                    <button class="btn btn-primary w-100">Add New Admin</button>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
