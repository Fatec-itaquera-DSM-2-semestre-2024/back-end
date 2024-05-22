// Verifica se há um token armazenado na sessão
const token = sessionStorage.getItem('token');

if (!token) {
    // Redireciona para a página de login
    window.location.href = '../../index.html';
} else {
    // O token está presente, permita o acesso à página
    console.log('Token encontrado:', token);
}

function logout() {
    // Remove o token da sessão
    sessionStorage.removeItem('token');

    // Redireciona para a página inicial
    window.location.href = '../../index.html';
}

function ver_reservas(){
    fetch('http://localhost:80/src/Router/Reservas.php', {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Não autorizado');
            } else {
                throw new Error('Sem rede ou não conseguiu localizar o recurso');
            }
        }
        return response.json();
    })
    .then(data => {
        resultado.innerHTML = `
            <table>
                <tr>
                    <th>id_reserva </th>
                    <th>destinatario_reserva </th>
                    <th>observacao_reserva </th>
                    <th>data_reserva </th>
                    <th>horario_inicio </th>
                    <th>horario_fim </th>
                    <th>confirmada_reserva </th>
                    <th>id_usuario </th>
                </tr>

                ${data.reservas.map(reserva => `
                    <tr>
                        <td>${reserva.id}</td>
                        <td>${reserva.destinatario_reserva}</td>
                        <td>${reserva.observacao_reserva}</td>
                        <td>${reserva.data_reserva}</td>
                        <td>${reserva.horario_inicio}</td>
                        <td>${reserva.horario_fim}</td>
                        <td>${reserva.confirmada_reserva}</td>
                        <td>${reserva.id_usuario}</td>
                    </tr>
                `).join('')}
            </table>
        `;
    })
    .catch(error => alert('Erro na requisição: ' + error));
}

function toggle_criar(){
    const blur = document.getElementById('blur');
    blur.classList.toggle('active');
    const popup1 = document.getElementById('popup1');
    popup1.classList.toggle('active');
}

function toggle_alterar(){
    const blur = document.getElementById('blur');
    blur.classList.toggle('active');
    const popup2 = document.getElementById('popup2');
    popup2.classList.toggle('active');
}

function criar_reserva(){
    const destinatario_reserva = document.getElementById('destinatario_reserva').value;
    const observacao_reserva = document.getElementById('observacao_reserva').value;
    const data_reserva = document.getElementById('data_reserva').value;
    const horario_inicio = document.getElementById('horario_inicio').value;
    const horario_fim = document.getElementById('horario_fim').value;
    const confirmada_reserva = document.getElementById('confirmada_reserva').check;
    if (!destinatario_reserva || !observacao_reserva || !data_reserva || !horario_inicio || !horario_fim) {
        alert("Por favor, insira todos os dados!");
        return;
    }
    const reserva = {
        destinatario_reserva: destinatario_reserva,
        observacao_reserva: observacao_reserva,
        data_reserva: data_reserva,
        horario_inicio: horario_inicio,
        horario_fim: horario_fim,
        confirmada_reserva: confirmada_reserva,
        id_usuario: sessionStorage.getItem('token')
    };
    fetch('http://localhost:80/src/Router/Reservas.php', { 
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        },
        body: JSON.stringify(reserva)
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Não autorizado');
            } else {
                throw new Error('Sem rede ou não conseguiu localizar o recurso');
            }
        }
        return response.json();
    })
    .then(data => {
        if(!data.status){
            alert('Rserva já existe!')
        }else{
            alert('Rserva criada!')
        } 
       
    })
    .catch(error => alert('Erro na requisição: ' + error));
}

function getReserva() {
    const userId = document.getElementById("getReservaId").value;

    fetch('http://localhost:80/src/Router/Reservas.php?id=' + userId, {
        method: 'GET'
    })
    .then(response => {
        if (!response.ok) {
            if (response.status === 401) {
                throw new Error('Não autorizado');
            } else {
                throw new Error('Sem rede ou não conseguiu localizar o recurso');
            }
        }
        return response.json();
    })
    .then(data => {
        if (data.reservas.length === 0) {
            alert('Reserva não encontrada');
        } else {
            const reserva = data.reservas[0];
            document.getElementById('destinatario_reserva').value = reserva.destinatario_reserva;
            document.getElementById('observacao_reserva').value = reserva.observacao_reserva;
            document.getElementById('data_reserva').value = reserva.data_reserva;
            document.getElementById('horario_inicio').value = reserva.horario_inicio;
            document.getElementById('horario_fim').value = reserva.horario_fim;
            document.getElementById('confirmada_reserva').checked = reserva.confirmada_reserva;
        }
    })
    .catch(error => alert('Erro: ' + error));
}