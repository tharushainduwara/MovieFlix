<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Set user data
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$role = $_SESSION['role'];

// Set demo data
$email = $role === 'admin' ? 'admin@movieflix.com' : 'user@movieflix.com';
$join_date = '2024-01-01';
?>
<?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <h2 class="section-title">User Profile</h2>
    
    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 40px; margin-top: 30px;">
        <!-- Profile Sidebar -->
        <div class="profile-sidebar" style="background: #222; padding: 30px; border-radius: 10px; height: fit-content;">
            <div style="text-align: center; margin-bottom: 30px;">
                <div style="width: 100px; height: 100px; background: var(--primary); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 36px; color: white;">
                    <?php echo strtoupper(substr($username, 0, 1)); ?>
                </div>
                <h3 style="margin-bottom: 5px;"><?php echo htmlspecialchars($username); ?></h3>
                <p style="color: var(--gray); font-size: 14px;">
                    Member since <?php echo date('M Y', strtotime($join_date)); ?>
                </p>
            </div>
            
            <ul style="border-top: 1px solid #333; padding-top: 20px;">
                <li style="margin-bottom: 15px;">
                    <a href="profile.php" style="color: var(--primary); display: block; padding: 8px 0;">
                        <i class="fas fa-user"></i> Profile Information
                    </a>
                </li>
                <li style="margin-bottom: 15px;">
                    <a href="index.php" style="color: var(--gray); display: block; padding: 8px 0;">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                </li>
                <?php if($role === 'admin'): ?>
                <li style="margin-bottom: 15px;">
                    <a href="admin.php" style="color: var(--gray); display: block; padding: 8px 0;">
                        <i class="fas fa-cog"></i> Admin Panel
                    </a>
                </li>
                <?php endif; ?>
                <li>
                    <a href="logout.php" style="color: var(--gray); display: block; padding: 8px 0;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Profile Content -->
        <div class="profile-content">
            <div style="background: #222; padding: 30px; border-radius: 10px; margin-bottom: 20px;">
                <h3 style="margin-bottom: 20px; color: var(--primary);">Profile Information</h3>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 8px; color: var(--light);">Username</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($username); ?>" readonly style="background: #333; color: var(--light);">
                    </div>
                    
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 8px; color: var(--light);">Email</label>
                        <input type="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" readonly style="background: #333; color: var(--light);">
                    </div>
                    
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 8px; color: var(--light);">Member Since</label>
                        <input type="text" class="form-control" value="<?php echo date('F j, Y', strtotime($join_date)); ?>" readonly style="background: #333; color: var(--light);">
                    </div>
                    
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 8px; color: var(--light);">Account Type</label>
                        <input type="text" class="form-control" value="<?php echo $role === 'admin' ? 'Administrator' : 'Standard User'; ?>" readonly style="background: #333; color: var(--light);">
                    </div>
                </div>
            </div>
            
            <!-- Recent Activity -->
            <div style="background: #222; padding: 30px; border-radius: 10px;">
                <h3 style="margin-bottom: 20px; color: var(--primary);">Recent Activity</h3>
                
                <div style="color: var(--gray);">
                    <p>No recent activity to display.</p>
                    <p style="margin-top: 15px; font-size: 14px;">
                        Your watch history and preferences will appear here as you use MovieFlix.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>