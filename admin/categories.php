<?php
// Check if user is admin - session already started in admin.php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Generate CSRF token if absent
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

include __DIR__ . '/../config/database.php';

// ── ADD CATEGORY ─────────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {

    // CSRF check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error = "Invalid request. Please try again.";
    } else {
        $name        = trim($_POST['name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        // Input validation
        if ($name === '' || strlen($name) > 100) {
            $error = "Category name is required and must be 100 characters or fewer.";
        } elseif (strlen($description) > 500) {
            $error = "Description must be 500 characters or fewer.";
        } else {
            $stmt = $conn->prepare("INSERT INTO categories (name, description) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $description);

            if ($stmt->execute()) {
                $success = "Category added successfully!";
            } else {
                error_log("DB error adding category: " . $stmt->error);
                $error = "Could not add category. Please try again.";
            }
            $stmt->close();
        }

        // Rotate token
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// ── DELETE CATEGORY ───────────────────────────────────────────────────────────
if (isset($_GET['delete'])) {

    // CSRF check via GET token
    if (!isset($_GET['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])) {
        $error = "Invalid request. Please try again.";
    } else {
        $category_id = intval($_GET['delete']);

        if ($category_id <= 0) {
            $error = "Invalid category ID.";
        } else {
            $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
            $stmt->bind_param("i", $category_id);

            if ($stmt->execute()) {
                $success = "Category deleted successfully!";
            } else {
                error_log("DB error deleting category id=$category_id: " . $stmt->error);
                $error = "Could not delete category. Please try again.";
            }
            $stmt->close();
        }

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// ── FETCH CATEGORIES ──────────────────────────────────────────────────────────
$result = $conn->query("SELECT * FROM categories ORDER BY name");
?>

<div class="admin-header">
    <h2>Categories Management</h2>
</div>

<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<!-- Add Category Form -->
<div style="background: #222; padding: 25px; border-radius: 10px; margin-bottom: 30px;">
    <h3 style="margin-bottom: 20px; color: var(--primary);">Add New Category</h3>
    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div style="display: grid; grid-template-columns: 1fr 2fr 1fr; gap: 15px; align-items: end;">
            <div class="form-group">
                <label>Category Name <small>(max 100 chars)</small></label>
                <input type="text" name="name" class="form-control" maxlength="100" required>
            </div>
            <div class="form-group">
                <label>Description <small>(max 500 chars)</small></label>
                <input type="text" name="description" class="form-control" maxlength="500" required>
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
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo (int)$row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td>
                        <a href="admin.php?page=categories&delete=<?php echo (int)$row['id']; ?>&csrf_token=<?php echo urlencode($_SESSION['csrf_token']); ?>"
                           class="btn"
                           style="padding: 5px 10px; font-size: 12px; background: #dc3545;"
                           onclick="return confirm('Are you sure you want to delete this category?')">
                            Delete
                        </a>
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
