<?php
require 'db.php';
include 'header.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $msg = trim($_POST['message']);

    if ($name && $email && $msg) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $msg);

        if ($stmt->execute()) {
            $message = "Message sent successfully!";
        } else {
            $message = "Something went wrong. Try again later.";
        }
    } else {
        $message = "Please fill out all required fields.";
    }
}
?>

<section id="contact" class="section container contact-section" style="padding-top: 10rem;">
    

    <?php if ($message): ?>
        <div style="text-align:center; color: var(--main-color); font-weight: bold; margin-bottom: 1rem;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="contact-wrapper">
        <!-- Contact Image -->
        <div class="contact-img">
            <img src="Images/Untitled design (3).png" alt="Contact Us" />
        </div>

        <!-- Contact Form -->
        <form method="POST" class="contact-form">
            <div class="form-group">
                <input type="text" name="name" placeholder="Your Name" required />
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Your Email" required />
            </div>
            <div class="form-group">
                <input type="text" name="subject" placeholder="Subject" />
            </div>
            <div class="form-group">
                <textarea name="message" rows="5" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="btn">Send Message</button>
        </form>
    </div>
</section>

<?php include 'footer.php'; ?>
