<?php
session_start();
include 'config/database.php';
?>
<?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <h2 class="section-title">Privacy Policy</h2>
    
    <div style="background: #222; padding: 40px; border-radius: 10px; margin-top: 30px;">
        <div style="margin-bottom: 30px;">
            <p style="color: var(--gray); font-size: 16px; line-height: 1.6;">
                Last updated: <?php echo date('F j, Y'); ?>
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">1. Information We Collect</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We collect information you provide directly to us when you create an account, 
                use our services, or communicate with us. This may include:
            </p>
            <ul style="color: var(--gray); margin: 15px 0 15px 20px; line-height: 1.6;">
                <li>Personal information (name, email address, etc.)</li>
                <li>Account credentials</li>
                <li>Payment information</li>
                <li>Viewing preferences and watch history</li>
                <li>Device and connection information</li>
            </ul>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">2. How We Use Your Information</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We use the information we collect to:
            </p>
            <ul style="color: var(--gray); margin: 15px 0 15px 20px; line-height: 1.6;">
                <li>Provide, maintain, and improve our services</li>
                <li>Process your transactions and send related information</li>
                <li>Send you technical notices and support messages</li>
                <li>Respond to your comments and questions</li>
                <li>Personalize your experience and content recommendations</li>
                <li>Monitor and analyze trends and usage</li>
            </ul>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">3. Information Sharing</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We do not sell, trade, or otherwise transfer your personal information to 
                third parties without your consent, except in the following circumstances:
            </p>
            <ul style="color: var(--gray); margin: 15px 0 15px 20px; line-height: 1.6;">
                <li>With your consent</li>
                <li>To comply with legal obligations</li>
                <li>To protect and defend our rights and property</li>
                <li>With service providers who assist in our operations</li>
            </ul>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">4. Data Security</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We implement appropriate technical and organizational security measures 
                designed to protect your personal information against accidental or 
                unlawful destruction, loss, alteration, unauthorized disclosure, or access.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">5. Your Rights</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                You have the right to:
            </p>
            <ul style="color: var(--gray); margin: 15px 0 15px 20px; line-height: 1.6;">
                <li>Access and receive a copy of your personal information</li>
                <li>Rectify or update your personal information</li>
                <li>Delete your personal information</li>
                <li>Restrict or object to our processing of your personal information</li>
                <li>Data portability</li>
                <li>Withdraw consent at any time</li>
            </ul>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">6. Cookies and Tracking</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We use cookies and similar tracking technologies to track activity on our 
                service and hold certain information. Cookies are files with a small amount 
                of data which may include an anonymous unique identifier.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">7. Changes to This Policy</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We may update our Privacy Policy from time to time. We will notify you of 
                any changes by posting the new Privacy Policy on this page and updating 
                the "Last updated" date.
            </p>
        </div>

        <div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">8. Contact Us</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                If you have any questions about this Privacy Policy, please contact us:
            </p>
            <ul style="color: var(--gray); margin: 15px 0 15px 20px; line-height: 1.6;">
                <li>Email: privacy@movieflix.com</li>
                <li>Phone: +1 (555) 123-4567</li>
                <li>Address: 123 Movie Street, Cinema City, FL 12345</li>
            </ul>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>