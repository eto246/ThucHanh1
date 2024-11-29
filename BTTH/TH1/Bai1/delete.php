<?php
include 'config.php';

$id = $_GET['id'];

// Xóa dữ liệu từ bảng
$sql = "DELETE FROM flowers WHERE id = $id";
$conn->query($sql);

header('Location: admin.php');
?>
