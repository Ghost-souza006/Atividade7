<?php require_once 'exer6.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Moedas</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 550px; margin: 40px auto; padding: 20px; background: #f5f7fa; }
        .card { background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
        h2 { color: #1a73e8; border-bottom: 2px solid #1a73e8; padding-bottom: 10px; margin-top: 0; }
        .form-group { margin: 15px 0; }
        label { display: block; margin-bottom: 6px; font-weight: bold; color: #333; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 14px; }
        input:focus, select:focus { outline: none; border-color: #1a73e8; box-shadow: 0 0 0 2px rgba(26,115,232,0.2); }
        button { background: #1a73e8; color: white; padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-size: 16px; width: 100%; margin-top: 10px; font-weight: bold; }
        button:hover { background: #1557b0; }
        .alert { padding: 12px; margin: 15px 0; border-radius: 6px; font-weight: bold; }
        .alert.error { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }
        .alert.info { background: #e3f2fd; color: #1565c0; border: 1px solid #bbdefb; }
        .cotacao-sugestao { font-size: 12px; color: #666; margin-top: 4px; }
        hr { margin: 25px 0; border: none; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="card">
        <h2>💱 Conversor de Moedas</h2>
        <p style="color: #666; margin-bottom: 20px;">Converta Reais (BRL) para Dólar (USD) ou Euro (EUR)</p>
        
        <form method="post">
            <div class="form-group">
                <label for="valor">Valor em Reais (R$):</label>
                <input type="number" name="valor" id="valor" step="0.01" min="0" required placeholder="Ex: 100.00">
            </div>

            <div class="form-group">
                <label for="moeda">Moeda de Destino:</label>
                <select name="moeda" id="moeda" required>
                    <option value="">Selecione...</option>
                    <option value="USD">🇺🇸 USD - Dólar Americano</option>
                    <option value="EUR">🇪🇺 EUR - Euro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="cotacao">Cotação Atual (1 moeda = R$):</label>
                <input type="number" name="cotacao" id="cotacao" step="0.0001" min="0.01" required placeholder="Ex: 5.4500">
                <div class="cotacao-sugestao">
                    💡 Dica: Consulte cotações em <a href="https://www.bc.gov.br" target="_blank">Banco Central</a> ou <a href="https://exchangerate-api.com" target="_blank">APIs públicas</a>
                </div>
            </div>

            <button type="submit">🔄 Converter Agora</button>
        </form>

        <hr>

        <?php
        // Processa o formulário
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $valor = (float)($_POST['valor'] ?? 0);
            $moeda = strtoupper(trim($_POST['moeda'] ?? ''));
            $cotacao = (float)($_POST['cotacao'] ?? 0);
            $erro = "";

            // Validações com lógica de múltiplas rotas (switch + if/else)
            if ($valor <= 0) {
                $erro = "❌ O valor em reais deve ser maior que zero.";
            } elseif ($cotacao <= 0) {
                $erro = "❌ A cotação deve ser um valor positivo.";
            } elseif (!in_array($moeda, ['USD', 'EUR'])) {
                $erro = "❌ Moeda não suportada. Escolha USD ou EUR.";
            } else {
                // Instancia a classe e exibe resultado
                $conversor = new ConversorMoeda($moeda, $valor, $cotacao);
                echo $conversor->exibirResultado();
                
                // Exibe informação extra sobre a conversão
                echo "
                <div class='alert info' style='margin-top: 15px;'>
                    📊 <strong>Como foi calculado:</strong><br>
                    R$ " . number_format($valor, 2, ',', '.') . " ÷ " . number_format($cotacao, 4, ',', '.') . 
                    " = " . $conversor->formatarValor($conversor->converter(), $moeda) . "
                </div>
                ";
            }

            // Exibe erro se houver
            if ($erro) {
                echo "<div class='alert error'>{$erro}</div>";
            }
        }
        ?>

        <button onclick="window.location.href='indexprinci.php'" style="background: #6c757d; margin-top: 15px;">
            ← Voltar
        </button>
    </div>
</body>
</html>