<?php
session_start();
require 'db.php';



include 'header.php';
?>

<section class="section container" style="padding-top: 6rem;">
    <h2 class="section-title">Admin Dashboard</h2>

    <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; margin-top: 3rem;">
        <a href="sellcar.php" class="btn" style="padding: 2rem; width: 250px; text-align: center; font-size: 1.1rem;">➕ Add a New Car</a>

        <a href="view_messages.php" class="btn" style="padding: 2rem; width: 250px; text-align: center; font-size: 1.1rem;">📩 View Messages</a>

        <a href="buyer_requests.php" class="btn" style="padding: 2rem; width: 250px; text-align: center; font-size: 1.1rem;">🛒 Buyer Requests</a>
    </div>
</section>

<?php include 'footer.php'; ?>
