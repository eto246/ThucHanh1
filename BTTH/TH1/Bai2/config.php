<?php
// Kết nối tới CSDL
$host = 'localhost';
$db = 'quiz_db';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}