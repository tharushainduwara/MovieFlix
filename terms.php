<?php
session_start();
include 'config/database.php';
?>
<?php include 'includes/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <h2 class="section-title">Terms of Service</h2>
    
    <div style="background: #222; padding: 40px; border-radius: 10px; margin-top: 30px;">
        <div style="margin-bottom: 30px;">
            <p style="color: var(--gray); font-size: 16px; line-height: 1.6;">
                Last updated: <?php echo date('F j, Y'); ?>
            </p>
            <p style="color: var(--gray); line-height: 1.6;">
                Please read these Terms of Service carefully before using MovieFlix website 
                and services operated by MovieFlix Inc.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">1. Acceptance of Terms</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                By accessing or using our service, you agree to be bound by these Terms. 
                If you disagree with any part of the terms, you may not access the service.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">2. Accounts</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                When you create an account with us, you must provide accurate, complete, 
                and current information. You are responsible for safeguarding the password 
                and for all activities that occur under your account.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">3. Subscription and Billing</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                Our service is billed on a subscription basis. You will be billed in advance 
                on a recurring and periodic basis. Subscriptions are automatically renewed 
                unless you cancel before the renewal date.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">4. Free Trial</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                MovieFlix may offer a free trial for a limited period. After the free trial 
                period, your subscription will automatically convert to a paid subscription 
                unless you cancel before the trial ends.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">5. Content</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                Our service allows you to access and view content. You may not copy, 
                distribute, modify, transmit, or use our content for commercial purposes 
                without explicit permission.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">6. Prohibited Uses</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                You may use our service only for lawful purposes and in accordance with 
                these Terms. You agree not to use the service:
            </p>
            <ul style="color: var(--gray); margin: 15px 0 15px 20px; line-height: 1.6;">
                <li>In any way that violates any applicable law or regulation</li>
                <li>To transmit any advertising or promotional material</li>
                <li>To engage in any hacking or unauthorized access</li>
                <li>To interfere with or disrupt the service</li>
                <li>To attempt to circumvent any content protection measures</li>
            </ul>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">7. Intellectual Property</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                The service and its original content, features, and functionality are and 
                will remain the exclusive property of MovieFlix and its licensors. The 
                service is protected by copyright, trademark, and other laws.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">8. Termination</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We may terminate or suspend your account immediately, without prior notice 
                or liability, for any reason whatsoever, including without limitation if 
                you breach the Terms.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">9. Limitation of Liability</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                In no event shall MovieFlix, nor its directors, employees, partners, agents, 
                suppliers, or affiliates, be liable for any indirect, incidental, special, 
                consequential or punitive damages, including without limitation, loss of 
                profits, data, use, goodwill, or other intangible losses.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">10. Changes to Terms</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                We reserve the right, at our sole discretion, to modify or replace these 
                Terms at any time. By continuing to access or use our service after those 
                revisions become effective, you agree to be bound by the revised terms.
            </p>
        </div>

        <div style="margin-bottom: 30px;">
            <h3 style="color: var(--primary); margin-bottom: 15px;">11. Governing Law</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                These Terms shall be governed and construed in accordance with the laws of 
                the State of Florida, United States, without regard to its conflict of law provisions.
            </p>
        </div>

        <div>
            <h3 style="color: var(--primary); margin-bottom: 15px;">12. Contact Information</h3>
            <p style="color: var(--gray); line-height: 1.6;">
                If you have any questions about these Terms, please contact us:
            </p>
            <ul style="color: var(--gray); margin: 15px 0 15px 20px; line-height: 1.6;">
                <li>Email: legal@movieflix.com</li>
                <li>Phone: +1 (555) 123-4567</li>
                <li>Address: 123 Movie Street, Cinema City, FL 12345</li>
            </ul>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>