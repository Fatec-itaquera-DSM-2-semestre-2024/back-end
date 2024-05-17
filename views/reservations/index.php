<!DOCTYPE html>
<html>
<head>
    <title>Reservas de Salas de Aula</title>
</head>
<body>
    <h2>Reservas de Salas de Aula</h2>
    <a href="/reservations/create">Adicionar Reserva</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome da Sala</th>
            <th>Data</th>
            <th>Hora de Início</th>
            <th>Hora de Término</th>
            <th>Ações</th>
        </tr>
        <?php
        foreach ($reservations as $reservation) {
            echo "<tr>
                <td>{$reservation['id']}</td>
                <td>{$reservation['nome_sala']}</td>
                <td>{$reservation['data']}</td>
                <td>{$reservation['hora_inicio']}</td>
                <td>{$reservation['hora_fim']}</td>
                <td>
                    <a href='/reservations/edit/{$reservation['id']}'>Editar</a> |
                    <a href='/reservations/delete/{$reservation['id']}'>Excluir</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
