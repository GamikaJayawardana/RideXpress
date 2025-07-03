


<?php

require 'db.php';
include 'header.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand = trim($_POST['brand']);
    $model = trim($_POST['model']);
    $year = intval($_POST['year']);
    $fuel_type = $_POST['fuel_type'];
    $transmission = $_POST['transmission'];
    $mileage = intval($_POST['mileage']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);

    $image = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $img_name = time() . '_' . basename($_FILES['image']['name']);
        $target_dir = "uploads/";
        $target_file = $target_dir . $img_name;

        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $target_file;
            } else {
                $message = "Error uploading image.";
            }
        } else {
            $message = "Only JPG, JPEG, PNG & GIF files allowed.";
        }
    }

    if (!$message) {
        $stmt = $conn->prepare("INSERT INTO cars (brand, model, year, fuel_type, transmission, mileage, price, description, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissidss", $brand, $model, $year, $fuel_type, $transmission, $mileage, $price, $description, $image);
        if ($stmt->execute()) {
            $message = "Car listed successfully!";
        } else {
            $message = "Database error: " . $conn->error;
        }
    }
}
?>

<section class="section container" style="padding-top: 8rem;">
    <h2 class="section-title">Sell Your Car</h2>
    <?php if ($message): ?>
        <p class="sellcar-message" style="text-align:center; color: var(--main-color); font-weight: 700; margin-bottom:1rem;"><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>
    <form class="sellcar-form" action="sellcar.php" method="POST" enctype="multipart/form-data" style="max-width: 600px; margin: 0 auto; display: flex; flex-direction: column; gap: 1rem;">
        <input type="text" name="brand" placeholder="Brand" required />
        <input type="text" name="model" placeholder="Model" required />
        <input type="number" name="year" placeholder="Year" min="1900" max="<?= date('Y') ?>" required />
        <select name="fuel_type" required>
            <option value="" disabled selected>Select Fuel Type</option>
            <option value="Petrol">Petrol</option>
            <option value="Diesel">Diesel</option>
            <option value="Hybrid">Hybrid</option>
            <option value="Electric">Electric</option>
        </select>
        <select name="transmission" required>
            <option value="" disabled selected>Select Transmission</option>
            <option value="Manual">Manual</option>
            <option value="Automatic">Automatic</option>
        </select>
        <input type="number" name="mileage" placeholder="Mileage (km)" min="0" required />
        <input type="number" name="price" placeholder="Price (Rs)" min="0" step="0.01" required />
        <textarea name="description" rows="4" placeholder="Description (optional)"></textarea>
        <input type="file" name="image" accept="image/*" />
        <button type="submit" class="btn">List My Car</button>
    </form>
</section>

<?php include 'footer.php'; ?>
