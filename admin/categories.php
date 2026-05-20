<?php
// Check if user is admin - session already started in admin.php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Include database configuration with correct path
include __DIR__ . '/../config/database.php';

// Handle form submission for adding categories
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_category'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    
    $sql = "INSERT INTO categories (name, description) VALUES ('$name', '$description')";
    
    if ($conn->query($sql) === TRUE) {
        $success = "Category added successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Handle category deletion
if (isset($_GET['delete'])) {
    $category_id = intval($_GET['delete']);
    $sql = "DELETE FROM categories WHERE id=$category_id";
    
    if ($conn->query($sql) === TRUE) {
        $success = "Category deleted successfully!";
    } else {
        $error = "Error deleting category: " . $conn->error;
    }
}

// Display categories
$result = $conn->query("SELECT * FROM categories ORDER BY name");
?>

<div class="admin-header">
    <h2>Categories Management</h2>
</div>

<?php if(isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if(isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>

<!-- Add Category Form -->
<div style="background: #222; padding: 25px; border-radius: 10px; margin-bottom: 30px;">
    <h3 style="margin-bottom: 20px; color: var(--primary);">Add New Category</h3>
    <form method="POST" action="">
        <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 15px; align-items: end;">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" required>
            </div>
            <div>
                <button type="submit" name="add_category" class="btn">Add Category</button>
            </div>
        </div>
    </form>
</div>

<!-- Categories Table -->
<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
                        <a href="admin.php?page=categories&delete=<?php echo $row['id']; ?>" class="btn" style="padding: 5px 10px; font-size: 12px; background: #dc3545;" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align: center;">No categories found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>