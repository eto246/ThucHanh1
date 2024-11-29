<?php
// Đường dẫn tới file CSV
$filename = "C:/xampp/htdocs/read_project/students.csv";

// Mảng chứa dữ liệu sinh viên
$sinhvien = [];

// Mở file CSV
if (($handle = fopen($filename, "r")) !== FALSE) {
    // Đọc dòng đầu tiên (tiêu đề)
    $headers = fgetcsv($handle, 1000, ",");

    // Đọc từng dòng dữ liệu
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $sinhvien[] = array_combine($headers, $data);
    }

    fclose($handle);
}
?>