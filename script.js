// Array para armazenar as perguntas do quiz
const quizData = [];

// Índice da pergunta atual
let currentQuestionIndex = 0;

// Pontuação do usuário
let score = 0;

// Função para verificar a autenticação do administrador
function checkAdminAuthentication() {
  // Implemente a lógica de verificação de autenticação do administrador aqui
  // Pode ser por meio de uma sessão, token, etc.
  // Por enquanto, vamos assumir que o usuário admin está autenticado.
  return true;
}

// Função para carregar a próxima pergunta
function loadNextQuestion() {
  const questionContainer = document.getElementById("question-container");
  const optionsContainer = document.getElementById("options-container");
  const nextButton = document.getElementById("next-button");

  if (currentQuestionIndex < quizData.length) {
    const currentQuestion = quizData[currentQuestionIndex];

    questionContainer.textContent = currentQuestion.question_text;

    optionsContainer.innerHTML = "";
    for (let i = 0; i < currentQuestion.options.length; i++) {
      const optionButton = document.createElement("button");
      optionButton.textContent = currentQuestion.options[i];
      optionButton.onclick = function() {
        checkAnswer(i, currentQuestion.correct_option);
      };
      optionsContainer.appendChild(optionButton);
    }

    nextButton.style.display = "none";
  } else {
    // Quiz concluído
    questionContainer.textContent = `Você concluiu o quiz! Pontuação final: ${score} de ${quizData.length}`;
    optionsContainer.innerHTML = "";
    nextButton.style.display = "none";
  }

  currentQuestionIndex++;
}

// Função para verificar a resposta do usuário
function checkAnswer(selectedOption, correctOption) {
  const nextButton = document.getElementById("next-button");

  if (selectedOption === correctOption) {
    score++;
  }

  // Mostra o botão "Próxima Pergunta"
  nextButton.style.display = "block";
}

// Carrega as perguntas ao carregar a página
fetch('get_questions.php')
  .then(response => response.json())
  .then(data => {
    quizData.push(...data);
    if (checkAdminAuthentication()) {
      loadNextQuestion();
    } else {
      alert("Acesso não autorizado. Faça login como administrador.");
    }
  })
  .catch(error => console.error('Error:', error));
