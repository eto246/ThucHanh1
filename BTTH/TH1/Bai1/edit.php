<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM flowers WHERE id = $id";
$result = $conn->query($sql);
$flower = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];

    if (!empty($_FILES['image']['name'])) {
        $imagePath = 'images/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        $imagePath = $flower['image'];
    }

    // Cập nhật dữ liệu
    $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $name, $description, $imagePath, $id);
    $stmt->execute();

    header('Location: admin.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin hoa</title>
</head>
<body>
    <h1>Sửa thông tin hoa</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Tên hoa:</label><br>
        <input type="text" id="name" name="name" value="<?= $flower['name'] ?>" required><br>
        <label for="description">Mô tả:</label><br>
        <textarea id="description" name="description" required><?= $flower['description'] ?></textarea><br>
        <label for="image">Ảnh:</label><br>
        <input type="file" id="image" name="image"><br>
        <img src="<?= $flower['image'] ?>" alt="<?= $flower['name'] ?>" width="100"><br><br>
        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>
