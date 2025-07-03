<?php
include 'header.php';
?>


     <!-- Home -->
   <!-- Hero / Header Section -->
<section id="home" class="hero-section">
    <div class="hero-overlay">
        <div class="hero-content">
            <h1>Fast Deals. Smooth Rides.</h1>
            <p>Find your dream car with RideXpress today.</p>
            <a href="browse.php" class="btn hero-btn">Browse Cars</a>
        </div>
    </div>
</section>


    
    <!-- Brands -->
    <section id="brands" class="container-brands">
        
        <div class="brand-logos">
            <img src="Images/Brands/brand01.png" alt="Toyota" />
            <img src="Images/Brands/brand02.png" alt="Toyota" />
            <img src="Images/Brands/brand03.png" alt="Toyota" />
            <img src="Images/Brands/brand04.png" alt="Toyota" />
            <img src="Images/Brands/brand05.png" alt="Toyota" />
            <img src="Images/Brands/brand06.png" alt="Toyota" />
            <img src="Images/Brands/brand07.png" alt="Toyota" />
            <img src="Images/Brands/brand08.png" alt="Toyota" />
            
        </div>
    </section>


    <!-- Featured Cars -->
<!-- Featured Cars -->
<section id="featured" class="section container">
    <h2 class="section-title">Featured Cars</h2>
    <div class="featured-cars">

        <?php
        require 'db.php';
        $query = "SELECT * FROM cars ORDER BY id DESC LIMIT 6"; // Last 6 added cars
        $result = $conn->query($query);

        if ($result->num_rows > 0):
            while ($car = $result->fetch_assoc()):
        ?>
            <div class="car-card">
                <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['model']) ?>">
                <div class="car-info">
                    <h3><?= htmlspecialchars($car['brand']) . ' ' . htmlspecialchars($car['model']) . ' ' . htmlspecialchars($car['year']) ?></h3>
                    <p class="price">Rs. <?= number_format($car['price'], 2) ?></p>
                    <ul class="car-details">
                        <li><i class="fa-solid fa-gas-pump"></i> <?= htmlspecialchars($car['fuel_type']) ?></li>
                        <li><i class="fa-solid fa-cogs"></i> <?= htmlspecialchars($car['transmission']) ?></li>
                        <li><i class="fa-solid fa-road"></i> <?= number_format($car['mileage']) ?> km</li>
                    </ul>
                    <div class="card-buttons">
                        <a href="buyform.php?id=<?= $car['id'] ?>" class="btn">Buy Now</a>

                    </div>
                </div>
            </div>
           
        <?php
        
            endwhile;
        else:
            echo "<p style='text-align:center;'>No cars listed yet.</p>";
        endif;
        ?>

         <a href="browse.php" class="btn hero-btn">View More</a>
    </div>
</section>




     <!--About-->
       
     <section class="about container" id="about">
        
            
        <div class="about-text">
                <h3>About Us</h3>
                
                <h2>Affordable Prices with<br>Top-Quality Cars</h2>
                <br>
                <p>RideXpress is your trusted partner in finding the vehicle that 
             fits both your lifestyle and your budget.</p>
            <br>

             <!--about button-->
             <div>
             <a href="aboutus.php" class="btn">Learn More</a>
             </div>
        </div> 
        <div class="about-img">
            <img src="Images/R.png" alt="" width="50px">
        </div>   
     </section>  

     <!-- Contact Form -->
<!-- Contact Section -->
<section id="contact" class="section container contact-section">
    <h2 class="section-title">Get in Touch</h2>
    <div class="contact-wrapper">
        <!-- Contact Image -->
        <div class="contact-img">
            <img src="Images/Untitled design (3).png" alt="Contact Us" />
        </div>

        <!-- Contact Form -->
       <form class="contact-form" method="POST" action="contact.php">
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



    


     <!-- Login & Signup Forms -->
<div id="popup-container" class="popup-container">
    <div class="form-box" id="loginForm">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="#" onclick="toggleForm('signup')">Sign Up</a></p>
    </div>

    <div class="form-box" id="signupForm" style="display: none;">
        <span class="close-btn" onclick="closePopup()">&times;</span>
        <h2>Sign Up</h2>
        <form method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="#" onclick="toggleForm('login')">Login</a></p>
    </div>
</div>
<div id="popup-message" class="popup-message" style="display: none;">
    <p id="popup-text"></p>
</div>


<script>
    function showPopup(message) {
    const popup = document.getElementById('popup-message');
    const text = document.getElementById('popup-text');
    text.innerText = message;
    popup.style.display = 'block';

    // Hide after 3 seconds
    setTimeout(() => {
        popup.style.display = 'none';
    }, 3000);
}

window.onload = function () {
    const urlParams = new URLSearchParams(window.location.search);

    // Show login or signup popup based on URL params
    if (urlParams.get('showLogin') === '1') {
        openPopup('login');
    } else if (urlParams.get('showSignup') === '1') {
        openPopup('signup');
    }

    // Show custom messages
    const msg = urlParams.get('msg');
    if (msg) {
        switch (msg) {
            case 'registered':
                showPopup("Registration successful. Please login.");
                break;
            case 'exists':
                showPopup("Username or Email already exists.");
                break;
            case 'error':
                showPopup("An error occurred. Please try again.");
                break;
            case 'wrongpass':
                showPopup("Incorrect password. Try again.");
                break;
            case 'notfound':
                showPopup("User not found. Please register.");
                break;
            case 'messagesent':
                showPopup("Your message has been sent successfully.");
                break;
            case 'messagefail':
                showPopup("Failed to send your message. Try again.");
                 break;
            case 'emptyfields':
                   showPopup("Please fill all required fields.");
                   break;
            default:
                // No action
        }
    }

    // Optional: Remove query params from URL after showing popup
    setTimeout(() => {
        if (msg || urlParams.get('showLogin') || urlParams.get('showSignup')) {
            history.replaceState(null, null, window.location.pathname);
        }
    }, 3500);

    

};



    

     <!-- link to Js-->
<script src="Scripts/main.js"></script>


<?php include 'footer.php'; ?>