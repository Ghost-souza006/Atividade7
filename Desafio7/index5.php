<?php require_once 'exer5.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Produto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Informações do Produto</h2>
    
    <form method="post">
        <label>Nome do Produto: <input type="text" name="nome" required></label><br><br>
        
        <label>Quantidade em Estoque: <input type="number" step="1" min="0" name="quantidade" required></label><br><br>
        
        <label>Valor Unitário (R$): <input type="number" step="0.01" min="0" name="valor" required></label><br><br>
        
        <button type="submit">Cadastrar</button>
    </form>
    
    <hr>
    
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Instancia a classe Produto com os dados do formulário
        $produto = new Produto(
            $_POST['nome'],
            (int)$_POST['quantidade'],
            (float)$_POST['valor']
        );
        
        echo "<h3>Resultado:</h3>";
        
        // Chama o método exibirDetalhes
        echo $produto->exibirDetalhes();
    }
    ?>
    
    <button onclick="window.location.href='indexprinci.php'">Voltar</button>
</body>
</html>