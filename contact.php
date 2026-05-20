<?php
session_start();
include 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    
    // In a real application, you would save this to database or send email
    $success = "Thank you for your message! We'll get back to you within 24 hours.";
}
?>
<?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <h2 class="section-title">Contact Us</h2>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin-top: 40px;">
        <!-- Contact Form -->
        <div>
            <h3 style="margin-bottom: 20px; color: var(--primary);">Send us a Message</h3>
            
            <?php if(isset($success)): ?>
                <div class="alert alert-success"><?php echo $success; ?></div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" required value="<?php echo isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">
                </div>
                
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" required><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>
                </div>
                
                <button type="submit" class="btn">Send Message</button>
            </form>
        </div>
        
        <!-- Contact Information -->
        <div>
            <h3 style="margin-bottom: 20px; color: var(--primary);">Get in Touch</h3>
            <div style="background: #222; padding: 30px; border-radius: 10px;">
                <div style="margin-bottom: 25px;">
                    <h4 style="color: var(--primary); margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-map-marker-alt"></i> Address
                    </h4>
                    <p style="color: var(--gray);">
                        123 Movie Street<br>
                        Cinema City, FL 12345<br>
                        United States
                    </p>
                </div>
                
                <div style="margin-bottom: 25px;">
                    <h4 style="color: var(--primary); margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-phone"></i> Phone
                    </h4>
                    <p style="color: var(--gray);">+1 (555) 123-4567</p>
                </div>
                
                <div style="margin-bottom: 25px;">
                    <h4 style="color: var(--primary); margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-envelope"></i> Email
                    </h4>
                    <p style="color: var(--gray);">support@movieflix.com</p>
                </div>
                
                <div>
                    <h4 style="color: var(--primary); margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                        <i class="fas fa-clock"></i> Business Hours
                    </h4>
                    <p style="color: var(--gray);">
                        <strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM<br>
                        <strong>Saturday:</strong> 10:00 AM - 4:00 PM<br>
                        <strong>Sunday:</strong> Closed
                    </p>
                </div>
            </div>

            <!-- FAQ Section -->
            <div style="margin-top: 30px;">
                <h4 style="color: var(--primary); margin-bottom: 15px;">Frequently Asked Questions</h4>
                <div style="background: #222; padding: 20px; border-radius: 10px;">
                    <div style="margin-bottom: 15px;">
                        <strong style="color: var(--light);">Q: How can I reset my password?</strong>
                        <p style="color: var(--gray); margin: 5px 0 0 0; font-size: 14px;">
                            A: Click on "Forgot Password" on the login page or contact our support team.
                        </p>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <strong style="color: var(--light);">Q: Is there a free trial available?</strong>
                        <p style="color: var(--gray); margin: 5px 0 0 0; font-size: 14px;">
                            A: Yes! We offer a 7-day free trial for all new users.
                        </p>
                    </div>
                    <div>
                        <strong style="color: var(--light);">Q: Can I download movies to watch offline?</strong>
                        <p style="color: var(--gray); margin: 5px 0 0 0; font-size: 14px;">
                            A: Yes, our mobile app allows you to download movies for offline viewing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>