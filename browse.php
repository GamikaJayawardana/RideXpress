<?php
require 'db.php';
include 'header.php';


$brand = $_GET['brand'] ?? '';
$fuel = $_GET['fuel'] ?? '';
$transmission = $_GET['transmission'] ?? '';
$year = $_GET['year'] ?? '';


$sql = "SELECT * FROM cars WHERE 1=1";
$params = [];
$types = "";

if (!empty($brand)) {
    $sql .= " AND brand LIKE ?";
    $params[] = "%" . $brand . "%";
    $types .= "s";
}
if (!empty($fuel)) {
    $sql .= " AND fuel_type = ?";
    $params[] = $fuel;
    $types .= "s";
}
if (!empty($transmission)) {
    $sql .= " AND transmission = ?";
    $params[] = $transmission;
    $types .= "s";
}
if (!empty($year)) {
    $sql .= " AND year = ?";
    $params[] = $year;
    $types .= "i";
}

$sql .= " ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<section class="section container" style="padding-top: 8rem;">
    

    <!-- Filter Form -->
    <form method="GET" style="margin-bottom: 2rem; display: flex; flex-wrap: wrap; gap: 1rem; justify-content: center;">
        <input type="text" name="brand" placeholder="Brand" value="<?= htmlspecialchars($brand) ?>" style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #ccc;">

        <select name="fuel" style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #ccc;">
            <option value="">Fuel Type</option>
            <option value="Petrol" <?= $fuel === 'Petrol' ? 'selected' : '' ?>>Petrol</option>
            <option value="Diesel" <?= $fuel === 'Diesel' ? 'selected' : '' ?>>Diesel</option>
            <option value="Hybrid" <?= $fuel === 'Hybrid' ? 'selected' : '' ?>>Hybrid</option>
            <option value="Electric" <?= $fuel === 'Electric' ? 'selected' : '' ?>>Electric</option>
        </select>

        <select name="transmission" style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #ccc;">
            <option value="">Transmission</option>
            <option value="Manual" <?= $transmission === 'Manual' ? 'selected' : '' ?>>Manual</option>
            <option value="Automatic" <?= $transmission === 'Automatic' ? 'selected' : '' ?>>Automatic</option>
        </select>

        <input type="number" name="year" placeholder="Year" value="<?= htmlspecialchars($year) ?>" style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #ccc; width: 100px;">

        <button type="submit" class="btn" style="color: #fff; background-color: #b61817; padding: 0.5rem 1.5rem; border: none; border-radius: 0.5rem;">Filter</button>
    </form>

    <!-- Cars List -->
    <div class="featured-cars">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($car = $result->fetch_assoc()): ?>
                <div class="car-card">
                    <?php if ($car['image'] && file_exists($car['image'])): ?>
                        <img src="<?= htmlspecialchars($car['image']) ?>" alt="<?= htmlspecialchars($car['brand'] . ' ' . $car['model']) ?>" />
                    <?php else: ?>
                        <img src="Images/R.png" alt="No Image Available" />
                    <?php endif; ?>
                    <div class="car-info">
                        <h3><?= htmlspecialchars($car['brand'] . ' ' . $car['model'] . ' (' . $car['year'] . ')') ?></h3>
                        <p class="price">Rs. <?= number_format($car['price'], 2) ?></p>
                        <ul class="car-details">
                            <li><i class="fa-solid fa-gas-pump"></i> <?= htmlspecialchars($car['fuel_type']) ?></li>
                            <li><i class="fa-solid fa-cogs"></i> <?= htmlspecialchars($car['transmission']) ?></li>
                            <li><i class="fa-solid fa-road"></i> <?= number_format($car['mileage']) ?> km</li>
                        </ul>
                        <p><?= nl2br(htmlspecialchars($car['description'])) ?></p>
                        <div class="card-buttons">
                            <a href="buyform.php?id=<?= $car['id'] ?>" class="btn">Buy Now</a>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center;">No cars found matching your filters.</p>
        <?php endif; ?>
    </div>
</section>

<?php include 'footer.php'; ?>
