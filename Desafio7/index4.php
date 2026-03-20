<?php require_once 'exer4.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro de Carro</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Informações do Carro</h2>
<form method="post">
<label>Modelo: <input type="text" name="modelo" required></label><br><br>
<label>Combustível (Etanol/Gasolina): <input type="text" name="combustivel" required></label><br><br>
<label>Tanque Cheio (Litros): <input type="number" step="0.01" name="tanque" required></label><br><br>
<label>Consumo Médio (km/l): <input type="number" step="0.01" name="consumo" required></label><br><br>
<label>Km Já Rodados: <input type="number" step="1" name="kmRodados" required></label><br><br>
<label>Preço do Combustível (R$): <input type="number" step="0.01" name="preco" required></label><br><br>
<button type="submit">Calcular</button>
</form>
<hr>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// Instancia a classe Carro com os dados do formulário
$carro = new Carro(
$_POST['modelo'],
$_POST['combustivel'],
(float)$_POST['tanque'],
(float)$_POST['consumo'],
(float)$_POST['kmRodados'],
(float)$_POST['preco']
);
echo "<h3>Resultado:</h3>";
// Chama o método exibirDetalhes
echo $carro->exibirDetalhes();
}
?>
<button onclick="window.location.href='indexprinci.php'">Voltar</button>
</body>
</html>