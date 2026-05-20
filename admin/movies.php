<?php
// Check if user is admin - session already started in admin.php
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../login.php');
    exit();
}

// Include database configuration with correct path
include __DIR__ . '/../config/database.php';

// Handle form submission for adding/editing movies
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $year = intval($_POST['year']);
    $category_id = intval($_POST['category_id']);
    $rating = floatval($_POST['rating']);
    $poster_url = $conn->real_escape_string($_POST['poster_url']);
    
    if (isset($_POST['movie_id']) && !empty($_POST['movie_id'])) {
        // Update existing movie
        $movie_id = intval($_POST['movie_id']);
        $sql = "UPDATE movies SET title='$title', description='$description', year='$year', category_id='$category_id', rating='$rating', poster_url='$poster_url' WHERE id=$movie_id";
        $action = 'updated';
    } else {
        // Add new movie
        $sql = "INSERT INTO movies (title, description, year, category_id, rating, poster_url) VALUES ('$title', '$description', '$year', '$category_id', '$rating', '$poster_url')";
        $action = 'added';
    }
    
    if ($conn->query($sql) === TRUE) {
        $success = "Movie $action successfully!";
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Handle movie deletion
if (isset($_GET['delete'])) {
    $movie_id = intval($_GET['delete']);
    $sql = "DELETE FROM movies WHERE id=$movie_id";
    
    if ($conn->query($sql) === TRUE) {
        $success = "Movie deleted successfully!";
    } else {
        $error = "Error deleting movie: " . $conn->error;
    }
}

// Get categories for dropdown
$categories_result = $conn->query("SELECT * FROM categories");

// Display movies table
$result = $conn->query("
    SELECT movies.*, categories.name as category_name 
    FROM movies 
    LEFT JOIN categories ON movies.category_id = categories.id 
    ORDER BY movies.created_at DESC
");
?>

<div class="admin-header">
    <h2>Movies Management</h2>
    <button onclick="showAddMovieForm()" class="btn">Add New Movie</button>
</div>

<?php if(isset($success)): ?>
    <div class="alert alert-success"><?php echo $success; ?></div>
<?php endif; ?>

<?php if(isset($error)): ?>
    <div class="alert alert-error"><?php echo $error; ?></div>
<?php endif; ?>

<!-- Add Movie Form (Initially Hidden) -->
<div id="addMovieForm" style="display: none; background: #222; padding: 30px; border-radius: 10px; margin-bottom: 30px;">
    <h3 style="margin-bottom: 20px; color: var(--primary);">Add New Movie</h3>
    <form method="POST" action="">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Year</label>
                <input type="number" name="year" class="form-control" min="1900" max="2030" required>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    <?php while($category = $categories_result->fetch_assoc()): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Rating</label>
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
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td>
                        <img src="<?php echo $row['poster_url']; ?>" 
                             alt="<?php echo htmlspecialchars($row['title']); ?>" 
                             style="width: 60px; height: 90px; object-fit: cover; border-radius: 4px;"
                             onerror="this.src='https://via.placeholder.com/60x90/333333/666666?text=No+Poster'">
                    </td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td>⭐ <?php echo $row['rating']; ?></td>
                    <td>
                        <a href="admin.php?page=edit_movie&id=<?php echo $row['id']; ?>" class="btn" style="padding: 5px 10px; font-size: 12px;">Edit</a>
                        <a href="admin.php?page=movies&delete=<?php echo $row['id']; ?>" class="btn" style="padding: 5px 10px; font-size: 12px; background: #dc3545;" onclick="return confirm('Are you sure you want to delete this movie?')">Delete</a>
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
function showAddMovieForm() {
    document.getElementById('addMovieForm').style.display = 'block';
}

function hideAddMovieForm() {
    document.getElementById('addMovieForm').style.display = 'none';
}
</script>