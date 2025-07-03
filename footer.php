<footer class="footer">
    <div class="footer-container">
        <div class="footer-box">
            <div class="logo">
                <img src="Images/logo_white.png" alt="RideXpress Logo" class="logo" />
            </div>
            <div class="social">
                <img src="Images/Social/icons8-facebook-40 (1).png" alt="facebook logo" class="social" />
                <img src="Images/Social/icons8-whatsapp-40 (1).png" alt="whatsapp logo" class="social" />
                <img src="Images/Social/icons8-youtube-40 (1).png" alt="youtube logo" class="social" />
                <img src="Images/Social/icons8-instagram-40 (1).png" alt="instagram logo" class="social" />
            </div>
        </div>
        <div class="footer-box">
            <h3>Page</h3>
            <a href="index.php">Home</a>
            <a href="browse.php">Cars</a>
            <a href="aboutus.php">About Us</a>
            <a href="contactus.php">Contact Us</a>
        </div>
        <div class="footer-box">
            <h3>Legal</h3>
            <a href="#">Privacy</a>
            <a href="#">Refund Policy</a>
            <a href="#">Cookie Policy</a>
            <a href="#">Terms of Service</a>
            <a href="admin_panel.php">Admin Panel</a>
        </div>
        <div class="footer-box">
            <h3>Visit Us</h3>
            <p>149/3 Hewlock road, Sri Lanka</p>
        </div>
    </div>
</footer>

<div class="Copyright">
    <p>&copy; 2025 RideXpress All Rights Reserved.</p>
</div>

<!-- Login Popup Container (reuse your previous popup code) -->
<div id="popup-container" class="popup-container" style="display:none;">
    <div class="form-box" id="loginForm">
        <span class="close-btn" onclick="document.getElementById('popup-container').style.display='none'">&times;</span>
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Sign Up</a></p>
    </div>
</div>

</body>
</html>
