<?php require_once 'exer2.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Informações do Aluno</h2>
    <form method="post">
        <label>Nome: <input type="text" name="nome" required></label><br><br>
        <label>Disciplina: <input type="text" name="disciplina" required></label><br><br>
        <label>Nota 1: <input type="number" step="0.01" name="nota1" required></label><br><br>
        <label>Nota 2: <input type="number" step="0.01" name="nota2" required></label><br><br>
        <label>Nota 3: <input type="number" step="0.01" name="nota3" required></label><br><br>
        <button type="submit">Calcular</button>
    </form>

    <hr>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Instancia a classe Aluno com os dados do formulário
        $aluno = new Aluno(
            $_POST['nome'],
            $_POST['disciplina'],
            (float)$_POST['nota1'],
            (float)$_POST['nota2'],
            (float)$_POST['nota3']
        );

        echo "<h3>Resultado:</h3>";
        // Chama o método exibirDetalhes (que não requer parâmetros na classe Aluno)
        echo $aluno->exibirDetalhes();
    }
    ?>

    <button onclick="window.location.href='indexprinci.php'">Voltar</button>
</body>
</html>