<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>RideXpress</title>
    <link rel="stylesheet" href="Styles/styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<header>
    <div class="nav container">
        <i class="fa-solid fa-bars" id="menu-icon"></i>
        <img src="Images/logo_blue.png" alt="RideXpress Logo" class="logo" />
        <ul class="navbar">
            <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
            <li><a href="browse.php" class="<?= basename($_SERVER['PHP_SELF']) == 'browse.php' ? 'active' : '' ?>">Cars</a></li>
            
            <li><a href="aboutus.php">About</a></li>
            <li><a href="contactus.php">Contact</a></li>

            <?php if (isset($_SESSION['username'])): ?>
                <li><a href="logout.php" class="btn">Logout (<?= htmlspecialchars($_SESSION['username']) ?>)</a></li>
            <?php else: ?>
                <li><a href="#" id="login-link" class="btn">Login</a></li>
            <?php endif; ?>
        </ul>
        
    </div>
</header>

<script>
    // Show login popup on clicking login nav link
    document.addEventListener('DOMContentLoaded', () => {
        const loginLink = document.getElementById('login-link');
        if (loginLink) {
            loginLink.addEventListener('click', e => {
                e.preventDefault();
                document.getElementById('popup-container').style.display = 'flex';
            });
        }
    });
</script>
