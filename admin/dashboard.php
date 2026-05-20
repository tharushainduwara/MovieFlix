<?php
// Check if user is admin - session already started in admin.php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Include database configuration with correct path
include __DIR__ . '/../config/database.php';

// Get statistics
$movies_count = $conn->query("SELECT COUNT(*) as count FROM movies")->fetch_assoc()['count'];
$users_count = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$categories_count = $conn->query("SELECT COUNT(*) as count FROM categories")->fetch_assoc()['count'];
$recent_movies = $conn->query("SELECT * FROM movies ORDER BY created_at DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);
?>

<div class="admin-header">
    <h2>Dashboard</h2>
    <p>Welcome back, <?php echo $_SESSION['username']; ?>!</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3><?php echo $movies_count; ?></h3>
        <p>Total Movies</p>
        <i class="fas fa-film" style="font-size: 24px; color: var(--primary); margin-top: 10px;"></i>
    </div>
    <div class="stat-card">
        <h3><?php echo $users_count; ?></h3>
        <p>Registered Users</p>
        <i class="fas fa-users" style="font-size: 24px; color: var(--primary); margin-top: 10px;"></i>
    </div>
    <div class="stat-card">
        <h3><?php echo $categories_count; ?></h3>
        <p>Categories</p>
        <i class="fas fa-list" style="font-size: 24px; color: var(--primary); margin-top: 10px;"></i>
    </div>
    <div class="stat-card">
        <h3>24/7</h3>
        <p>Streaming</p>
        <i class="fas fa-play-circle" style="font-size: 24px; color: var(--primary); margin-top: 10px;"></i>
    </div>
</div>

<!-- Recent Movies Table -->
<div class="recent-section">
    <h3 style="margin-bottom: 20px; color: var(--primary);">Recent Movies Added</h3>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Year</th>
                <th>Rating</th>
                <th>Added Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($recent_movies)): ?>
                <?php foreach($recent_movies as $movie): ?>
                    <tr>
                        <td><?php echo $movie['id']; ?></td>
                        <td><?php echo htmlspecialchars($movie['title']); ?></td>
                        <td><?php echo $movie['year']; ?></td>
                        <td>⭐ <?php echo $movie['rating']; ?></td>
                        <td><?php echo date('M j, Y', strtotime($movie['created_at'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No movies found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Quick Actions -->
<div class="quick-actions" style="margin-top: 30px;">
    <h3 style="margin-bottom: 20px; color: var(--primary);">Quick Actions</h3>
    <div style="display: flex; gap: 15px;">
        <a href="admin.php?page=movies" class="btn">
            <i class="fas fa-plus"></i> Manage Movies
        </a>
        <a href="admin.php?page=users" class="btn" style="background: #666;">
            <i class="fas fa-user-plus"></i> Manage Users
        </a>
        <a href="admin.php?page=categories" class="btn" style="background: #666;">
            <i class="fas fa-tags"></i> Manage Categories
        </a>
    </div>
</div>