<!DOCTYPE html>
<html>
<head>
    <title>Editar Reserva</title>
</head>
<body>
    <h2>Editar Reserva</h2>
    <form method="post" action="">
        Nome da Sala: <input type="text" name="nome_sala" value="<?php echo $res['nome_sala']; ?>" required><br>
        Data: <input type="date" name="data" value="<?php echo $res['data']; ?>" required><br>
        Hora de Início: <input type="time" name="hora_inicio" value="<?php echo $res['hora_inicio']; ?>" required><br>
        Hora de Término: <input type="time" name="hora_fim" value="<?php echo $res['hora_fim']; ?>" required><br>
        <input type="submit" value="Atualizar">
    </form>
    <br>
    <a href="/reservations">Voltar</a>
</body>
</html>
