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

// ── ADD / EDIT MOVIE ──────────────────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error = "Invalid request. Please try again.";
    } else {
        // Sanitise & validate
        $title       = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $year        = intval($_POST['year'] ?? 0);
        $category_id = intval($_POST['category_id'] ?? 0);
        $rating      = round(floatval($_POST['rating'] ?? 0), 1);
        $poster_url  = trim($_POST['poster_url'] ?? '');

        $validation_errors = [];

        if ($title === '' || strlen($title) > 255) {
            $validation_errors[] = "Title is required and must be 255 characters or fewer.";
        }
        if ($description === '') {
            $validation_errors[] = "Description is required.";
        }
        if ($year < 1888 || $year > 2030) {
            $validation_errors[] = "Year must be between 1888 and 2030.";
        }
        if ($category_id <= 0) {
            $validation_errors[] = "Please select a valid category.";
        }
        if ($rating < 0 || $rating > 10) {
            $validation_errors[] = "Rating must be between 0 and 10.";
        }
        if ($poster_url !== '' && !filter_var($poster_url, FILTER_VALIDATE_URL)) {
            $validation_errors[] = "Poster URL must be a valid URL.";
        }

        if (!empty($validation_errors)) {
            $error = implode(' ', $validation_errors);
        } else {
            $movie_id = intval($_POST['movie_id'] ?? 0);

            if ($movie_id > 0) {
                // UPDATE
                $stmt = $conn->prepare(
                    "UPDATE movies SET title=?, description=?, year=?, category_id=?, rating=?, poster_url=? WHERE id=?"
                );
                $stmt->bind_param("ssiidsi", $title, $description, $year, $category_id, $rating, $poster_url, $movie_id);
                $action = 'updated';
            } else {
                // INSERT
                $stmt = $conn->prepare(
                    "INSERT INTO movies (title, description, year, category_id, rating, poster_url) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $stmt->bind_param("ssiids", $title, $description, $year, $category_id, $rating, $poster_url);
                $action = 'added';
            }

            if ($stmt->execute()) {
                $success = "Movie {$action} successfully!";
            } else {
                error_log("DB error saving movie: " . $stmt->error);
                $error = "Could not save movie. Please try again.";
            }
            $stmt->close();
        }

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// ── DELETE MOVIE ──────────────────────────────────────────────────────────────
if (isset($_GET['delete'])) {

    if (!isset($_GET['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_GET['csrf_token'])) {
        $error = "Invalid request. Please try again.";
    } else {
        $movie_id = intval($_GET['delete']);

        if ($movie_id <= 0) {
            $error = "Invalid movie ID.";
        } else {
            $stmt = $conn->prepare("DELETE FROM movies WHERE id = ?");
            $stmt->bind_param("i", $movie_id);

            if ($stmt->execute()) {
                $success = "Movie deleted successfully!";
            } else {
                error_log("DB error deleting movie id=$movie_id: " . $stmt->error);
                $error = "Could not delete movie. Please try again.";
            }
            $stmt->close();
        }

        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}

// ── FETCH DATA ────────────────────────────────────────────────────────────────
$categories_result = $conn->query("SELECT * FROM categories ORDER BY name");

$result = $conn->query("
    SELECT movies.*, categories.name AS category_name
    FROM movies
    LEFT JOIN categories ON movies.category_id = categories.id
    ORDER BY movies.created_at DESC
");
?>

<div class="admin-header">
    <h2>Movies Management</h2>
    <button onclick="showAddMovieForm()" class="btn">Add New Movie</button>
</div>

<?php if (isset($success)): ?>
    <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<!-- Add Movie Form (Initially Hidden) -->
<div id="addMovieForm" style="display: none; background: #222; padding: 30px; border-radius: 10px; margin-bottom: 30px;">
    <h3 style="margin-bottom: 20px; color: var(--primary);">Add New Movie</h3>
    <form method="POST" action="">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Title <small>(max 255 chars)</small></label>
                <input type="text" name="title" class="form-control" maxlength="255" required>
            </div>
            <div class="form-group">
                <label>Year <small>(1888–2030)</small></label>
                <input type="number" name="year" class="form-control" min="1888" max="2030" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php if ($categories_result): ?>
                        <?php while ($category = $categories_result->fetch_assoc()): ?>
                            <option value="<?php echo (int)$category['id']; ?>">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Rating <small>(0–10)</small></label>
                <input type="number" name="rating" class="form-control" step="0.1" min="0" max="10" required>
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <label>Poster URL</label>
                <input type="url" name="poster_url" class="form-control" placeholder="https://example.com/poster.jpg">
            </div>
            <div class="form-group" style="grid-column: 1 / -1;">
                <label>Description</label>
                <textarea name="description" class="form-control" rows="3" required></textarea>
            </div>
        </div>
        <div style="margin-top: 20px; display: flex; gap: 10px;">
            <button type="submit" class="btn">Add Movie</button>
            <button type="button" onclick="hideAddMovieForm()" class="btn" style="background: #666;">Cancel</button>
        </div>
    </form>
</div>

<table class="admin-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Poster</th>
            <th>Title</th>
            <th>Year</th>
            <th>Category</th>
            <th>Rating</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo (int)$row['id']; ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars($row['poster_url']); ?>"
                             alt="<?php echo htmlspecialchars($row['title']); ?>"
                             style="width: 60px; height: 90px; object-fit: cover; border-radius: 4px;"
                             onerror="this.src='https://via.placeholder.com/60x90/333333/666666?text=No+Poster'">
                    </td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo (int)$row['year']; ?></td>
                    <td><?php echo htmlspecialchars($row['category_name'] ?? '—'); ?></td>
                    <td>⭐ <?php echo htmlspecialchars($row['rating']); ?></td>
                    <td>
                        <a href="admin.php?page=edit_movie&id=<?php echo (int)$row['id']; ?>"
                           class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                        <a href="admin.php?page=movies&delete=<?php echo (int)$row['id']; ?>&csrf_token=<?php echo urlencode($_SESSION['csrf_token']); ?>"
                           class="btn" style="padding: 5px 10px; font-size: 12px; background: #dc3545;"
                           onclick="return confirm('Are you sure you want to delete this movie?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align: center;">No movies found</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
function showAddMovieForm()  { document.getElementById('addMovieForm').style.display = 'block'; }
function hideAddMovieForm()  { document.getElementById('addMovieForm').style.display = 'none';  }
</script>
