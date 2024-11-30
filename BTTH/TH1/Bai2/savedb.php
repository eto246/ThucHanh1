<?php
// Kết nối tới CSDL
include("config.php");

// Xóa toàn bộ dữ liệu trong bảng "questions" trước khi thêm dữ liệu mới
$sql_delete = "DELETE FROM questions";
$conn->query($sql_delete);

// Đọc tệp câu hỏi
$filename = "questions.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

if (!$questions) {
    die("Không thể đọc tệp câu hỏi.");
}

// Biến chứa các câu hỏi và đáp án
$current_question = "";
$answers = [];
$correct_answer = "";

// Duyệt qua từng dòng của tệp
foreach ($questions as $line) {
    // Nếu dòng bắt đầu bằng "Câu", có nghĩa là đó là một câu hỏi mới
    if (strpos($line, "Câu") === 0) {
        // Nếu có câu hỏi cũ, lưu vào CSDL
        if ($current_question != "") {
            // Đảm bảo không có giá trị NULL cho đáp án
            $answers['A'] = isset($answers['A']) ? $answers['A'] : '';
            $answers['B'] = isset($answers['B']) ? $answers['B'] : '';
            $answers['C'] = isset($answers['C']) ? $answers['C'] : '';
            $answers['D'] = isset($answers['D']) ? $answers['D'] : '';

            // Insert câu hỏi vào bảng "questions"
            $stmt = $conn->prepare("INSERT INTO questions (question, answer_a, answer_b, answer_c, answer_d, correct_answer) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $current_question, $answers['A'], $answers['B'], $answers['C'], $answers['D'], $correct_answer);
            $stmt->execute();
            $stmt->close();
        }

        // Cập nhật câu hỏi mới
        $current_question = trim(substr($line, strpos($line, ":") + 1));
        $answers = []; // reset answers
    }
    elseif (strpos($line, "Đáp án:") !== false) {
        // Nếu là đáp án đúng, lưu lại
        $correct_answer = trim(substr($line, strpos($line, ":") + 1));
    } else {
        // Lưu đáp án
        if (strpos($line, "A.") !== false) {
            $answers['A'] = trim(substr($line, 2));
        } elseif (strpos($line, "B.") !== false) {
            $answers['B'] = trim(substr($line, 2));
        } elseif (strpos($line, "C.") !== false) {
            $answers['C'] = trim(substr($line, 2));
        } elseif (strpos($line, "D.") !== false) {
            $answers['D'] = trim(substr($line, 2));
        }
    }
}

// Lưu câu hỏi cuối cùng vào CSDL
if ($current_question != "") {
    // Đảm bảo không có giá trị NULL cho đáp án
    $answers['A'] = isset($answers['A']) ? $answers['A'] : '';
    $answers['B'] = isset($answers['B']) ? $answers['B'] : '';
    $answers['C'] = isset($answers['C']) ? $answers['C'] : '';
    $answers['D'] = isset($answers['D']) ? $answers['D'] : '';

    $stmt = $conn->prepare("INSERT INTO questions (question, answer_a, answer_b, answer_c, answer_d, correct_answer) 
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $current_question, $answers['A'], $answers['B'], $answers['C'], $answers['D'], $correct_answer);
    $stmt->execute();
    $stmt->close();
}

$conn->close();
echo "Dữ liệu đã được lưu thành công!";
?>
