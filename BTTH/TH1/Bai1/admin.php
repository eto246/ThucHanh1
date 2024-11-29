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
    <title>Quản trị danh sách hoa</title>
</head>
<link href="dep.css" rel="stylesheet">
<body>
    <h1>Quản trị danh sách hoa</h1>
    <a href="add.php" class="btthem">Thêm hoa</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Tên hoa</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td><img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>" width="100"></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>">Sửa</a> |
                        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
