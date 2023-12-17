function addQuestion() {
  const question = document.getElementById("question").value;
  const options = document.getElementById("options").value.split(",");
  const correctOption = document.getElementById("correctOption").value;

  // Envia a pergunta para o servidor
  fetch('admin_add_question.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      question: question,
      options: options,
      correctOption: correctOption,
    }),
  })
  .then(response => response.json())
  .then(data => {
    alert(data.message);
  })
  .catch((error) => {
    console.error('Error:', error);
  });
}
