<?php
session_start();
include 'config/database.php';

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF check
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error = "Invalid request. Please try again.";
    } else {
        $name    = trim($_POST['name']    ?? '');
        $email   = trim($_POST['email']   ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        // Validation
        $validation_errors = [];

        if ($name === '' || strlen($name) > 100) {
            $validation_errors[] = "Full name is required and must be 100 characters or fewer.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $validation_errors[] = "Please enter a valid email address.";
        }
        if ($subject === '' || strlen($subject) > 200) {
            $validation_errors[] = "Subject is required and must be 200 characters or fewer.";
        }
        if ($message === '' || strlen($message) > 5000) {
            $validation_errors[] = "Message is required and must be 5000 characters or fewer.";
        }

        if (!empty($validation_errors)) {
            $error = implode(' ', $validation_errors);
        } else {
            // In a real application: save to DB or send email here.
            // Inputs are already trimmed; escape when inserting into DB with prepared statements.
            $success = "Thank you for your message! We'll get back to you within 24 hours.";
            // Clear inputs after success
            $name = $email = $subject = $message = '';
        }

        // Rotate CSRF token
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
?>
<?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <h2 class="section-title">Contact Us</h2>

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin-top: 40px;">
        <!-- Contact Form -->
        <div>
            <h3 style="margin-bottom: 20px; color: var(--primary);">Send us a Message</h3>

            <?php if (isset($success)): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <?php if (isset($error)): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" maxlength="100" required
                           value="<?php echo htmlspecialchars($name ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required
                           value="<?php echo htmlspecialchars($email ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" maxlength="200" required
                           value="<?php echo htmlspecialchars($subject ?? ''); ?>">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5" maxlength="5000" required><?php echo htmlspecialchars($message ?? ''); ?></textarea>
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
