<?php
session_start();
include 'config/database.php';

$featured_movie = null;
$top_rated_movies = [];
$new_releases = [];
$movies_by_category = [];
$total_movies = 0;

try {
    // Get the total movie count
    $total_movies_result = $conn->query("SELECT COUNT(id) as count FROM movies");
    if ($total_movies_result) {
        $total_movies = $total_movies_result->fetch_assoc()['count'];
    }

    if ($total_movies > 0) {
        // 1. Get the single TOP movie for the hero section
        $featured_query = $conn->query("
            SELECT m.*, c.name as category_name 
            FROM movies m 
            LEFT JOIN categories c ON m.category_id = c.id 
            ORDER BY m.rating DESC 
            LIMIT 1
        ");
        if ($featured_query) {
            $featured_movie = $featured_query->fetch_assoc();
        }

        // 2. Get Top 10 Rated Movies
        $top_rated_query = $conn->query("
            SELECT m.*, c.name as category_name 
            FROM movies m 
            LEFT JOIN categories c ON m.category_id = c.id 
            ORDER BY m.rating DESC 
            LIMIT 10
        ");
        if ($top_rated_query) {
            $top_rated_movies = $top_rated_query->fetch_all(MYSQLI_ASSOC);
        }

        // 3. Get 10 New Releases (by year)
        $new_releases_query = $conn->query("
            SELECT m.*, c.name as category_name 
            FROM movies m 
            LEFT JOIN categories c ON m.category_id = c.id 
            ORDER BY m.year DESC, m.rating DESC 
            LIMIT 10
        ");
        if ($new_releases_query) {
            $new_releases = $new_releases_query->fetch_all(MYSQLI_ASSOC);
        }

        // 4. Get movies for specific categories
        // === THIS IS THE LINE TO CHANGE ===
        // Add as many categories as you want here
        $categories_to_feature = ['Action', 'Sci-Fi', 'Comedy', 'Horror', 'Drama', 'Thriller']; 
        
        foreach ($categories_to_feature as $cat_name) {
            $stmt = $conn->prepare("
                SELECT m.*, c.name as category_name 
                FROM movies m 
                LEFT JOIN categories c ON m.category_id = c.id 
                WHERE c.name = ? 
                ORDER BY m.rating DESC 
                LIMIT 10
            ");
            $stmt->bind_param('s', $cat_name);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result && $result->num_rows > 0) {
                // Add the results to our array
                $movies_by_category[$cat_name] = $result->fetch_all(MYSQLI_ASSOC);
            }
            $stmt->close();
        }
    }

} catch (Exception $e) {
    error_log("Database error: " . $e->getMessage());
    // You could set an error message to display to the user
}
?>
<?php include 'includes/header.php'; ?>

<?php if ($total_movies > 0 && $featured_movie): ?>
<section class="hero" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('images/1.jpg') no-repeat center center/cover;">
    <div class="container">
        <div class="hero-content">
            <h1>Unlimited Movies, TV Shows, and More.</h1>
            <p>Browse our collection of <?php echo $total_movies; ?> amazing movies! Watch anywhere. Cancel anytime.</p>
            
            <?php if ($total_movies > 0): ?>
                <a href="movies.php" class="btn">Browse All Movies</a>
            <?php else: ?>
                <a href="populate_database.php" class="btn" style="background: orange;">🚨 Add Movies to Database</a>
            <?php endif; ?>
        </div>
    </div>
</section>

    <div class="container" style="margin-top: 50px;">

        <section class="movie-carousel-section">
            <h2 class="section-title">Top Rated Movies</h2>
            <div class="movie-carousel">
                <?php foreach ($top_rated_movies as $movie): ?>
                    <?php include 'includes/movie_card_template.php'; // Use a template ?>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="movie-carousel-section">
            <h2 class="section-title">New Releases</h2>
            <div class="movie-carousel">
                <?php foreach ($new_releases as $movie): ?>
                    <?php include 'includes/movie_card_template.php'; ?>
                <?php endforeach; ?>
            </div>
        </section>

        <?php foreach ($movies_by_category as $category_name => $movies): ?>
            <section class="movie-carousel-section">
                <h2 class="section-title"><?php echo htmlspecialchars($category_name); ?></h2>
                <div class="movie-carousel">
                    <?php foreach ($movies as $movie): ?>
                        <?php include 'includes/movie_card_template.php'; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>

    </div>

<?php else: ?>
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Welcome to MovieFlix</h1>
                <p>Your database appears to be empty. Add some movies to get started!</p>
                <a href="populate_database.php" class="btn" style="background: orange;">🚨 Add Movies to Database</a>
            </div>
        </div>
    </section>

    <div class="container" style="text-align: center; padding: 50px; background: #ff4444; color: white; margin-top: 20px; border-radius: 10px;">
        <h2>🚨 DATABASE EMPTY! 🚨</h2>
        <p>No movies found. Please run the database setup script.</p>
        <div style="margin-top: 20px;">
            <a href="populate_database.php" class="btn" style="background: white; color: #ff4444;">Populate Database</a>
        </div>
    </div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>