<?php require_once 'exer9.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-form">
        <h2>🧍 Calculadora de IMC</h2>
        
        <form method="post">
            <div class="form-group">
                <label for="nome">👤 Nome:</label>
                <input type="text" name="nome" id="nome" required placeholder="Ex: Maria Silva">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="peso">⚖️ Peso (kg):</label>
                    <input type="number" name="peso" id="peso" step="0.1" min="1" max="300" required placeholder="Ex: 70.5">
                </div>
                <div class="form-group">
                    <label for="altura">📏 Altura (m):</label>
                    <input type="number" name="altura" id="altura" step="0.01" min="0.5" max="2.5" required placeholder="Ex: 1.75">
                </div>
            </div>
            
            <div class="dica">
                💡 Fórmula: IMC = peso ÷ (altura × altura). Ex: 70 ÷ (1.75 × 1.75) = 22.9
            </div>

            <button type="submit" class="btn-primary">🧮 Calcular IMC</button>
        </form>

        <hr class="mt-20">

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $peso = (float)($_POST['peso'] ?? 0);
            $altura = (float)($_POST['altura'] ?? 0);
            
            $erro = "";

            // Validações
            if (empty($nome)) {
                $erro = "❌ O nome é obrigatório.";
            } elseif ($peso <= 0 || $peso > 300) {
                $erro = "❌ Peso inválido. Informe entre 1 e 300 kg.";
            } elseif ($altura <= 0 || $altura > 2.5) {
                $erro = "❌ Altura inválida. Informe entre 0.50 e 2.50 m.";
            } else {
                // Instancia a classe e exibe resultado
                $pessoa = new Pessoa($nome, $peso, $altura);
                echo "<h3>✅ Resultado:</h3>";
                echo $pessoa->exibirDetalhes();
                
                // Mensagem personalizada conforme classificação
                $classificacao = $pessoa->classificarIMC();
                if (strpos($classificacao, '🟢') !== false) {
                    echo "<div class='alert success'>
                        🎉 Parabéns! Seu IMC está na faixa saudável. Mantenha hábitos equilibrados!
                    </div>";
                } elseif (strpos($classificacao, '🟡') !== false) {
                    echo "<div class='alert info'>
                        💡 Dica: Consulte um nutricionista para orientação sobre ganho de peso saudável.
                    </div>";
                } elseif (strpos($classificacao, '🟠') !== false) {
                    echo "<div class='alert warning'>
                        ⚠️ Atenção: Sobrepeso pode aumentar riscos à saúde. Considere atividade física e alimentação balanceada.
                    </div>";
                } elseif (strpos($classificacao, '🔴') !== false || strpos($classificacao, '⚫') !== false) {
                    echo "<div class='alert error'>
                        🏥 Importante: Procure acompanhamento médico para orientação personalizada sobre seu peso.
                    </div>";
                }
            }

            if ($erro) {
                echo "<div class='alert error'>{$erro}</div>";
            }
        }
        ?>

        <button onclick="window.location.href='indexprinci.php'" class="btn-secondary">
            ← Voltar ao Menu
        </button>
    </div>
</body>
</html>