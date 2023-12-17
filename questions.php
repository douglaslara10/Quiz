<?php
require_once('db.php');

// Obtém todas as perguntas do banco de dados
function getQuestions() {
    global $conn;
    $query = "SELECT * FROM questions";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $questions = array();
        while ($row = $result->fetch_assoc()) {
            $questions[] = $row;
        }
        return $questions;
    } else {
        return false;
    }
}

// Adiciona uma nova pergunta ao banco de dados
function addQuestion($question, $options, $correctOption) {
    global $conn;
    $optionsString = implode(",", $options);
    $query = "INSERT INTO questions (question_text, options, correct_option) VALUES ('$question', '$optionsString', '$correctOption')";
    
    if ($conn->query($query) === TRUE) {
        echo "Question added successfully";
    } else {
        echo "Error adding question: " . $conn->error;
    }
}

// Verifica o método da requisição
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se a requisição for um POST, adiciona uma nova pergunta
    $question = $_POST['question'];
    $options = explode(",", $_POST['options']);
    $correctOption = $_POST['correctOption'];
    addQuestion($question, $options, $correctOption);
} else {
    // Se a requisição for um GET, retorna todas as perguntas
    $questions = getQuestions();
    echo json_encode($questions);
}
?>
