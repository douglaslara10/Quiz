<?php
require_once('db.php');

// Registra um novo usuário no banco de dados
function registerUser($username, $matricula, $password) {
    global $conn;
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, matricula, password) VALUES ('$username', '$matricula', '$hashedPassword')";
    
    if ($conn->query($query) === TRUE) {
        $response['message'] = "Usuário cadastrado com sucesso!";
    } else {
        $response['message'] = "Erro ao cadastrar usuário: " . $conn->error;
    }

    echo json_encode($response);
}

// Verifica se a requisição é do tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Registra o usuário
    registerUser($data['username'], $data['matricula'], $data['password']);
} else {
    // Responde com uma mensagem de erro se a requisição não for do tipo POST
    $response['message'] = "Método de requisição inválido.";
    echo json_encode($response);
}
?>
