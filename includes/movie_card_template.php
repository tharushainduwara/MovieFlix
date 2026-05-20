<div class="movie-card">
    <img src="<?php echo $movie['poster_url']; ?>" 
         alt="<?php echo htmlspecialchars($movie['title']); ?> Poster" 
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
        </div>
</div>