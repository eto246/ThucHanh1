<?php
// Đọc tệp câu hỏi
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (!$questions) {
    die("Không thể đọc tệp câu hỏi.");
}

// Biến chứa các câu hỏi và đáp án
$all_questions = [];
$current_question = [];
$answers = [];

// Duyệt qua từng dòng của tệp
foreach ($questions as $line) {
    // Nếu dòng bắt đầu bằng "Câu", có nghĩa là đó là một câu hỏi mới
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            // Nếu có câu hỏi cũ, lưu lại và bắt đầu câu hỏi mới
            $all_questions[] = $current_question;
            $current_question = [];
        }
        $current_question[] = $line; // Thêm câu hỏi vào mảng
    } elseif (strpos($line, "Đáp án:") !== false) {
        // Nếu dòng là đáp án đúng, lưu đáp án
        $answers[] = trim(substr($line, strpos($line, ":") + 1));
    } else {
        // Thêm các đáp án A, B, C, D vào câu hỏi
        $current_question[] = $line;
    }
}

// Thêm câu hỏi cuối cùng vào mảng
if (!empty($current_question)) {
    $all_questions[] = $current_question;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thi trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>THI </h1>
    <form action="submit.php" method="POST">
        <?php foreach ($all_questions as $index => $question): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <strong><?php echo $question[0]; ?></strong>
                </div>
                <div class="card-body">
                    <?php for ($i = 1; $i <= 4; $i++): ?>
                        <?php if (isset($question[$i])): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question<?php echo $index + 1; ?>" value="<?php echo chr(64 + $i); ?>" id="question<?php echo $index + 1 . chr(64 + $i); ?>">
                                <label class="form-check-label" for="question<?php echo $index + 1 . chr(64 + $i); ?>">
                                    <?php echo $question[$i]; ?>
                                </label>
                            </div>
                        <?php endif; ?>
                    <?php endfor; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</div>
</body>
</html>
