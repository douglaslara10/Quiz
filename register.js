function registerUser() {
  const username = document.getElementById("username").value;
  const matricula = document.getElementById("matricula").value;
  const password = document.getElementById("password").value;

  // Envia os dados de cadastro para o servidor
  fetch('register_user.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      username: username,
      matricula: matricula,
      password: password,
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
