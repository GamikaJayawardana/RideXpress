<?php
session_start();
require 'db.php';

// Optional: Protect the page so only logged-in admins can view


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Messages | RideXpress</title>
    <link rel="stylesheet" href="Styles/styles.css">
    <style>
        .message-table {
            width: 100%;
            border-collapse: collapse;
            margin: 4rem auto;
        }

        .message-table th, .message-table td {
            border: 1px solid #ccc;
            padding: 0.8rem;
            text-align: left;
        }

        .message-table th {
            background-color: var(--main-color);
            color: white;
        }

        .message-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .section-title {
            text-align: center;
            margin-top: 6rem;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<section class="container">
    <h2 class="section-title">Contact Messages</h2>
    <table class="message-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Submitted At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
            $result = $conn->query($sql);
            if ($result->num_rows > 0):
                $count = 1;
                while ($row = $result->fetch_assoc()):
            ?>
                <tr>
                    <td><?= $count++ ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['subject']) ?></td>
                    <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php
                endwhile;
            else:
                echo "<tr><td colspan='6' style='text-align:center;'>No messages found.</td></tr>";
            endif;
            ?>
        </tbody>
    </table>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
