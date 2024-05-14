function logar() {
  const email = document.getElementById("input_email").value;
  const senha = document.getElementById("input_senha").value;
  const lembrar = document.getElementById("input_lembrar").checked;

  const options = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      email: email,
      senha: senha,
      lembrar: lembrar,
    }),
  };

  fetch("http://localhost:80/src/Router/Usuarios/login", options)
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro na resposta da API");
      }
      return response.json();
    })
    .then((data) => {
      // Verifique se o token está presente nos dados recebidos
      if (data.token) {
        sessionStorage.setItem("token", data.token);
        console.log("Token armazenado com sucesso:", data.token);
        window.location.href = "./reservas.html";
      } else {
        console.error("Token não encontrado na resposta da API.");
      }
    })
    .catch((error) => {
      console.error("Erro ao obter o token:", error);
    });
}
