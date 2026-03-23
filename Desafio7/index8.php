<?php require_once 'exer8.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Financeira</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-form">
        <h2>💳 Calculadora de Parcelamento</h2>
        
        <form method="post">
            <div class="form-group">
                <label for="valor">💰 Valor da Compra (R$):</label>
                <input type="number" name="valor" id="valor" step="0.01" min="0.01" required placeholder="Ex: 1500.00">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="parcelas">🔢 Número de Parcelas:</label>
                    <input type="number" name="parcelas" id="parcelas" min="1" max="60" required placeholder="Ex: 12">
                </div>
                <div class="form-group">
                    <label for="taxa">📈 Taxa de Juros Mensal (%):</label>
                    <input type="number" name="taxa" id="taxa" step="0.01" min="0" max="50" required placeholder="Ex: 2.5">
                </div>
            </div>
            
            <div class="dica">
                💡 Taxa em % ao mês. Ex: 2.5 = 2,5% ao mês. Fórmula: Total = Valor × (1 + taxa)^n
            </div>

            <button type="submit" class="btn-primary">🧮 Calcular Parcelas</button>
        </form>

        <hr class="mt-20">

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $valor = (float)($_POST['valor'] ?? 0);
            $parcelas = (int)($_POST['parcelas'] ?? 0);
            $taxaPercentual = (float)($_POST['taxa'] ?? 0);
            $taxaDecimal = $taxaPercentual / 100; // Converte % para decimal
            
            $erro = "";

            // Validações
            if ($valor <= 0) {
                $erro = "❌ O valor da compra deve ser maior que zero.";
            } elseif ($parcelas <= 0 || $parcelas > 60) {
                $erro = "❌ Número de parcelas deve estar entre 1 e 60.";
            } elseif ($taxaPercentual < 0) {
                $erro = "❌ A taxa de juros não pode ser negativa.";
            } else {
                // Instancia a classe e exibe resultado
                $calc = new CalculadoraFinanceira($valor, $parcelas, $taxaDecimal);
                echo "<h3>✅ Resultado:</h3>";
                echo $calc->exibirDetalhes();
                
                // Alerta se juros estiverem altos
                if ($calc->calcularPorcentagemJuros() > 20) {
                    echo "<div class='alert warning'>
                        ⚠️ <strong>Atenção:</strong> Juros de " . number_format($calc->calcularPorcentagemJuros(), 1, ',', '.') . "%! 
                        Considere negociar ou pagar à vista.
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