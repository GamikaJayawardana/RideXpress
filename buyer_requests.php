<?php
require 'db.php';
include 'header.php';



$sql = "SELECT i.*, c.brand, c.model, c.year FROM inquiries i 
        JOIN cars c ON i.car_id = c.id 
        ORDER BY i.created_at DESC";

$result = $conn->query($sql);
?>

<section class="section container" style="padding-top: 6rem;">
    <h2 class="section-title">Buyer Requests</h2>

    <?php if ($result->num_rows > 0): ?>
        <div style="overflow-x:auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead style="background: var(--main-color); color: #fff;">
                    <tr>
                        <th style="padding: 12px;">Date</th>
                        <th style="padding: 12px;">Car</th>
                        <th style="padding: 12px;">Buyer Name</th>
                        <th style="padding: 12px;">Email</th>
                        <th style="padding: 12px;">Phone</th>
                        <th style="padding: 12px;">Message</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($inquiry = $result->fetch_assoc()): ?>
                        <tr style="border-bottom: 1px solid #ccc;">
                            <td style="padding: 10px;"><?= date('Y-m-d H:i', strtotime($inquiry['created_at'])) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($inquiry['brand'] . ' ' . $inquiry['model'] . ' (' . $inquiry['year'] . ')') ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($inquiry['name']) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($inquiry['email']) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($inquiry['phone']) ?></td>
                            <td style="padding: 10px;"><?= nl2br(htmlspecialchars($inquiry['message'])) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p style="text-align: center;">No buyer inquiries yet.</p>
    <?php endif; ?>
</section>

<?php include 'footer.php'; ?>
