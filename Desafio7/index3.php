<?php require_once 'exer3.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Pedido</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Informações do Pedido</h2>
    <form method="post">
        <label>Nome do Produto: <input type="text" name="produto" required></label><br><br>
        <label>Quantidade: <input type="number" name="quantidade" required></label><br><br>
        <label>Preço Unitário: <input type="number" step="0.01" name="preco" required></label><br><br>
        <label>Tipo de Cliente: 
            <select name="tipo" required>
                <option value="normal">Normal</option>
                <option value="premium">Premium</option>
            </select>
        </label><br><br>
        <button type="submit">Calcular</button>
    </form>

    <hr>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pedido = new Pedido(
            $_POST['produto'],
            (int)$_POST['quantidade'],
            (float)$_POST['preco'],
            $_POST['tipo']
        );

        echo "<h3>Resultado:</h3>";
        echo $pedido->exibirDetalhes();
    }
    ?>

    <button onclick="window.location.href='indexprinci.php'">Voltar</button>
</body>
</html>