<?php
// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Include database configuration
include 'config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MovieFlix</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <div class="logo">MovieFlix</div>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="admin.php">Admin Panel</a></li>
                <li><a href="profile.php"><?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </header>

    <div class="admin-container">
        <!-- Admin Sidebar -->
        <div class="admin-sidebar">
            <ul>
                <li class="<?php echo $page == 'dashboard' ? 'active' : ''; ?>">
                    <a href="admin.php?page=dashboard">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="<?php echo $page == 'movies' ? 'active' : ''; ?>">
                    <a href="admin.php?page=movies">
                        <i class="fas fa-film"></i> Movies
                    </a>
                </li>
                <li class="<?php echo $page == 'users' ? 'active' : ''; ?>">
                    <a href="admin.php?page=users">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
                <li class="<?php echo $page == 'categories' ? 'active' : ''; ?>">
                    <a href="admin.php?page=categories">
                        <i class="fas fa-list"></i> Categories
                    </a>
                </li>
            </ul>
        </div>

        <!-- Admin Content -->
        <div class="admin-content">
            <?php
            // Include the requested page
            $allowed_pages = ['dashboard', 'movies', 'users', 'categories'];
            if (in_array($page, $allowed_pages)) {
                include "admin/$page.php";
            } else {
                include "admin/dashboard.php";
            }
            ?>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>