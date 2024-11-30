<?php
include("config.php");

// Lấy dữ liệu từ bảng "questions" trong CSDL
$sql = "SELECT * FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $all_questions = [];
    while ($row = $result->fetch_assoc()) {
        $all_questions[] = [
            'id' => $row['id'],
            'question' => $row['question'],
            'answers' => [
                'A' => $row['answer_a'],
                'B' => $row['answer_b'],
                'C' => $row['answer_c'],
                'D' => $row['answer_d']
            ],
            'correct_answer' => $row['correct_answer']
        ];
    }
} else {
    die("Không có câu hỏi nào trong CSDL.");
}
$conn->close();
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
    <h1>THI TRẮC NGHIỆM</h1>
    <form action="submit.php" method="POST">
        <?php foreach ($all_questions as $index => $question): ?>
            <div class="card mb-4">
                <div class="card-header">
                    <strong><?php echo "Câu " . ($index + 1) . ": " . $question['question']; ?></strong>
                </div>
                <div class="card-body">
                    <?php foreach ($question['answers'] as $key => $answer): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question<?php echo $question['id']; ?>" value="<?php echo $key; ?>" id="question<?php echo $question['id'] . $key; ?>">
                            <label class="form-check-label" for="question<?php echo $question['id'] . $key; ?>">
                                <?php echo $key . ". " . $answer; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</div>
</body>
</html>
