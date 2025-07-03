<?php
session_start();
require 'db.php';
include 'header.php';

$car = null;
$message = '';

// Fetch car
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $car_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->bind_param("i", $car_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $car = $result->fetch_assoc();
}

// Handle form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $car_id = $_POST['car_id'];
    $buyer_name = trim($_POST['name']);
    $buyer_email = trim($_POST['email']);
    $buyer_phone = trim($_POST['phone']);
    $message_to_seller = trim($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO inquiries (car_id, name, email, phone, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $car_id, $buyer_name, $buyer_email, $buyer_phone, $message_to_seller);

    $message = $stmt->execute()
        ? "✅ Your inquiry has been sent. Seller will contact you soon."
        : "❌ Something went wrong. Please try again.";
}
?>

<!-- Inline CSS for layout -->
<style>
    .buy-section {
        padding-top: 8rem;
        max-width: 1200px;
        margin: auto;
    }

    .buy-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        align-items: flex-start;
        justify-content: center;
    }

    .car-card {
        background-color: #ffffff;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        width: 380px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .car-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .car-card img {
        width: 100%;
        height: 240px;
        object-fit: cover;
    }

    .car-info {
        padding: 2rem;
    }

    .car-info h3 {
        font-size: 1.3rem;
        color: var(--text-color);
        margin-bottom: 0.3rem;
    }

    .car-info .price {
        color: var(--main-color);
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .car-details {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
        font-size: 0.9rem;
        color: #444;
        margin-bottom: 1rem;
    }

    .car-details i {
        color: var(--main-color);
        margin-right: 8px;
    }

    .buy-form {
        flex: 1;
        min-width: 350px;
        background-color: #f9f9f9;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .buy-form input,
    .buy-form textarea {
        width: 100%;
        padding: 0.9rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
    }

    .buy-form button.btn {
        background-color: #961312;
        color: white;
        padding: 0.8rem;
        font-size: 1rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .buy-form button.btn:hover {
        background-color: #750f0e;
    }

    .message-banner {
        color: green;
        font-weight: bold;
        text-align: center;
        margin-bottom: 1rem;
    }

    .error-banner {
        text-align: center;
        color: red;
    }
</style>

<section class="section container buy-section">
    <h2 class="section-title">Buy Car</h2>

    <?php if ($message): ?>
        <p class="message-banner"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <?php if ($car): ?>
        <div class="buy-wrapper">
            <!-- Car Card -->
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
                </div>
            </div>

            <!-- Inquiry Form -->
            <form method="POST" class="buy-form">
                <input type="hidden" name="car_id" value="<?= $car['id'] ?>">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <textarea name="message" placeholder="Message to Seller (Optional)" rows="4"></textarea>
                <button type="submit" class="btn">Send Inquiry</button>
            </form>
        </div>
    <?php else: ?>
        <p class="error-banner">❌ Car not found.</p>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>
