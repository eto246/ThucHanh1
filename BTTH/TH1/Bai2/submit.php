<?php

// Đọc dữ liệu từ tệp câu hỏi
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Lưu đáp án đúng
$answers = [];
foreach ($questions as $line) {
    if (strpos($line, "Đáp án:") !== false) {
        $answers[] = trim(substr($line, strpos($line, ":") + 1)); // Lấy đáp án đúng
    }
}

// Tính điểm
$score = 0;
foreach ($_POST as $key => $userAnswer) {
    $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT); // Lấy số câu hỏi từ tên
    if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
        $score++;
    }
}

// Hiển thị kết quả
//echo "<div class='alert alert-success text-center'>";
//echo "Bạn trả lời đúng <strong>$score</strong>/" . count($answers) . " câu.";
//echo "</div>";

// Thêm nút làm lại
// echo "<a href='index.php' class='btn btn-primary'>Làm lại</a>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài thi</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Tiêu đề Kết quả -->
            <div class="text-center mb-4">
                <h1 class="display-4">Kết quả</h1>
            </div>

            <!-- Kết quả điểm số -->
            <div class="alert alert-success text-center">
                <h3>Bạn trả lời đúng <strong><?php echo $score; ?></strong> / <?php echo count($answers); ?> câu</h3>
            </div>

            <!-- Nút làm lại -->
            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-primary btn-lg">Làm lại</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS và Popper -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>