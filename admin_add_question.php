<?php
require_once('db.php');

// Adiciona uma nova pergunta ao banco de dados
function addQuestion($question, $options, $correctOption) {
    global $conn;
    $optionsString = implode(",", $options);
    $query = "INSERT INTO questions (question_text, options, correct_option) VALUES ('$question', '$optionsString', '$correctOption')";
    
    if ($conn->query($query) === TRUE) {
        $response['message'] = "Pergunta adicionada com sucesso!";
    } else {
        $response['message'] = "Erro ao adicionar pergunta: " . $conn->error;
    }

    echo json_encode($response);
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Adiciona a pergunta
    addQuestion($data['question'], $data['options'], $data['correctOption']);
} else {
    // Responde com uma mensagem de erro se a requisição não for do tipo POST
    $response['message'] = "Método de requisição inválido.";
    echo json_encode($response);
}
?>
