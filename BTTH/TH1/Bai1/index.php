<?php
include 'config.php';

// Lấy dữ liệu từ bảng flowers
$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách các loài hoa</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
<body>
    <h1>Danh sách các loài hoa</h1>
    <div class="flower-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="flower-item">
                    <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
                    <h2><?= $row['name'] ?></h2>
                    <p><?= $row['description'] ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Không có loài hoa nào được tìm thấy.</p>
        <?php endif; ?>
    </div>
</body>
</html>