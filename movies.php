<?php
session_start();
include 'config/database.php';

// Build query to get all movies with their category names
$query = "SELECT movies.*, categories.name as category_name 
    FROM movies 
    LEFT JOIN categories ON movies.category_id = categories.id 
    ORDER BY movies.rating DESC";

// Execute query and fetch all movies
$result = $conn->query($query);
$movies = $result->fetch_all(MYSQLI_ASSOC);
?>
<?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <h2 class="section-title">All Movies</h2>
    
    <div class="movies-grid">
        <?php if (count($movies) > 0): ?>
            <?php foreach($movies as $movie): ?>
                <div class="movie-card">
                    <img src="<?php echo $movie['poster_url']; ?>" 
                         alt="<?php echo htmlspecialchars($movie['title']); ?>" 
                         class="movie-poster"
                         loading="lazy"
                         onerror="this.src='https://via.placeholder.com/300x450/333333/666666?text=<?php echo urlencode($movie['title']); ?>'">
                    <div class="movie-info">
                        <h3 class="movie-title"><?php echo htmlspecialchars($movie['title']); ?></h3>
                        <div class="movie-meta">
                            <span><?php echo $movie['year']; ?></span>
                            <span>⭐ <?php echo $movie['rating']; ?></span>
                        </div>
                        <div class="movie-category"><?php echo $movie['category_name']; ?></div>
                        <div class="movie-description"><?php echo htmlspecialchars($movie['description']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-results" style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--gray);">
                <i class="fas fa-film" style="font-size: 48px; margin-bottom: 20px; opacity: 0.5;"></i>
                <h3>No movies found</h3>
                <p>There are currently no movies to display.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>