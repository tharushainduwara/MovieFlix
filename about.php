<?php
session_start();
include 'config/database.php';
?>
<?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <!-- Hero Section -->
    <section class="about-hero" style="text-align: center; padding: 60px 0;">
        <h1 style="font-size: 48px; margin-bottom: 20px;">About MovieFlix</h1>
        <p style="font-size: 20px; color: var(--gray); max-width: 800px; margin: 0 auto 40px;">
            Your ultimate destination for streaming the latest movies and TV shows. 
            We're committed to bringing you the best entertainment experience.
        </p>
    </section>

    <!-- Mission Section -->
    <section class="mission-section" style="margin: 80px 0;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; align-items: center;">
            <div>
                <h2 style="font-size: 36px; margin-bottom: 20px;">Our Mission</h2>
                <p style="font-size: 18px; line-height: 1.8; margin-bottom: 30px;">
                    At MovieFlix, we believe that everyone deserves access to quality entertainment. 
                    Our mission is to provide a seamless streaming experience with a vast library of 
                    movies and TV shows that cater to all tastes and preferences.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="stat-item" style="text-align: center;">
                        <h3 style="font-size: 32px; color: var(--primary); margin-bottom: 10px;">20+</h3>
                        <p style="color: var(--gray);">Movies & Shows</p>
                    </div>
                    <div class="stat-item" style="text-align: center;">
                        <h3 style="font-size: 32px; color: var(--primary); margin-bottom: 10px;">5+</h3>
                        <p style="color: var(--gray);">Categories</p>
                    </div>
                    <div class="stat-item" style="text-align: center;">
                        <h3 style="font-size: 32px; color: var(--primary); margin-bottom: 10px;">24/7</h3>
                        <p style="color: var(--gray);">Streaming</p>
                    </div>
                    <div class="stat-item" style="text-align: center;">
                        <h3 style="font-size: 32px; color: var(--primary); margin-bottom: 10px;">HD</h3>
                        <p style="color: var(--gray);">Quality</p>
                    </div>
                </div>
            </div>
            <div>
                <img src="https://source.unsplash.com/random/600x400/?cinema,theater" alt="Our Mission" style="width: 100%; border-radius: 10px;">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section" style="margin: 80px 0;">
        <h2 style="text-align: center; font-size: 36px; margin-bottom: 50px;">Why Choose MovieFlix?</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <div class="feature-card" style="background: #222; padding: 30px; border-radius: 10px; text-align: center;">
                <div style="font-size: 48px; color: var(--primary); margin-bottom: 20px;">
                    <i class="fas fa-film"></i>
                </div>
                <h3 style="font-size: 24px; margin-bottom: 15px;">Vast Library</h3>
                <p style="color: var(--gray);">
                    Access thousands of movies and TV shows from various genres and languages.
                </p>
            </div>
            <div class="feature-card" style="background: #222; padding: 30px; border-radius: 10px; text-align: center;">
                <div style="font-size: 48px; color: var(--primary); margin-bottom: 20px;">
                    <i class="fas fa-desktop"></i>
                </div>
                <h3 style="font-size: 24px; margin-bottom: 15px;">Multi-Device</h3>
                <p style="color: var(--gray);">
                    Watch on your TV, smartphone, tablet, or laptop - anytime, anywhere.
                </p>
            </div>
            <div class="feature-card" style="background: #222; padding: 30px; border-radius: 10px; text-align: center;">
                <div style="font-size: 48px; color: var(--primary); margin-bottom: 20px;">
                    <i class="fas fa-download"></i>
                </div>
                <h3 style="font-size: 24px; margin-bottom: 15px;">Download & Watch</h3>
                <p style="color: var(--gray);">
                    Download your favorite content and watch offline without internet.
                </p>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>