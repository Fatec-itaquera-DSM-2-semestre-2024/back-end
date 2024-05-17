<!DOCTYPE html>
<html>
<head>
    <title>Adicionar Reserva</title>
</head>
<body>
    <h2>Adicionar Nova Reserva</h2>
    <form method="post" action="">
        Nome da Sala: <input type="text" name="nome_sala" required><br>
        Data: <input type="date" name="data" required><br>
        Hora de Início: <input type="time" name="hora_inicio" required><br>
        Hora de Término: <input type="time" name="hora_fim" required><br>
        <input type="submit" value="Adicionar">
    </form>
    <br>
    <a href="/reservations">Voltar</a>
</body>
</html>
