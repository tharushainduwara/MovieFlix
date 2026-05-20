<?php
// Check if user is admin - session already started in admin.php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Include database configuration with correct path
include __DIR__ . '/../config/database.php';

// Handle user deletion
if (isset($_GET['delete'])) {
    $user_id = intval($_GET['delete']);
    // Prevent admin from deleting themselves
    if ($user_id != $_SESSION['user_id']) {
        $sql = "DELETE FROM users WHERE id=$user_id";
        if ($conn->query($sql) === TRUE) {
            $success = "User deleted successfully!";
        } else {
            $error = "Error deleting user: " . $conn->error;
        }
    } else {
        $error = "You cannot delete your own account!";
    }
}

// Display users table
$result = $conn->query("SELECT * FROM users ORDER BY created_at DESC");
?>

<div class="admin-header">
    <h2>Users Management</h2>
</div>

<?php if(isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if(isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Joined Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td>
                        <span style="padding: 4px 8px; border-radius: 4px; font-size: 12px; background: <?php echo $row['role'] == 'admin' ? 'var(--primary)' : '#666'; ?>; color: white;">
                            <?php echo ucfirst($row['role']); ?>
                        </span>
                    </td>
                    <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
                    <td>
                        <?php if ($row['id'] != $_SESSION['user_id']): ?>
                            <a href="admin.php?page=users&delete=<?php echo $row['id']; ?>" class="btn" style="padding: 5px 10px; font-size: 12px; background: #dc3545;" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        <?php else: ?>
                            <span style="color: var(--gray); font-size: 12px;">Current User</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align: center;">No users found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>