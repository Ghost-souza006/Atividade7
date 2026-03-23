<?php require_once 'exer10.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-form">
        <h2>🏨 Reserva de Hotel</h2>
        
        <form method="post">
            <div class="form-group">
                <label for="nome">👤 Nome do Hóspede:</label>
                <input type="text" name="nome" id="nome" required placeholder="Ex: Ana Souza">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="noites">🌙 Número de Noites:</label>
                    <input type="number" name="noites" id="noites" min="1" max="30" required placeholder="Ex: 3">
                </div>
                <div class="form-group">
                    <label for="quarto">🛏️ Tipo de Quarto:</label>
                    <select name="quarto" id="quarto" required>
                        <option value="">Selecione...</option>
                        <option value="simples">🟢 Simples - R$ 120/noite</option>
                        <option value="luxo">🔵 Luxo - R$ 200/noite</option>
                        <option value="suite">🟣 Suíte - R$ 350/noite</option>
                    </select>
                </div>
            </div>
            
            <div class="dica">
                💡 Desconto automático: 10% para 5+ noites | 15% para 10+ noites
            </div>

            <button type="submit" class="btn-primary">🔖 Confirmar Reserva</button>
        </form>

        <hr class="mt-20">

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');
            $noites = (int)($_POST['noites'] ?? 0);
            $quarto = strtolower(trim($_POST['quarto'] ?? ''));
            
            $erro = "";

            // Validações
            if (empty($nome)) {
                $erro = "❌ O nome do hóspede é obrigatório.";
            } elseif ($noites <= 0 || $noites > 30) {
                $erro = "❌ Número de noites deve estar entre 1 e 30.";
            } elseif (!in_array($quarto, ['simples', 'luxo', 'suite'])) {
                $erro = "❌ Tipo de quarto inválido. Escolha: simples, luxo ou suite.";
            } else {
                // Instancia a classe e exibe resultado
                $reserva = new ReservaHotel($nome, $noites, $quarto);
                echo "<h3>✅ Reserva Confirmada:</h3>";
                echo $reserva->exibirDetalhes();
                
                // Mensagem extra baseada no desconto
                if ($reserva->calcularDesconto() > 0) {
                    echo "<div class='alert success'>
                        🎉 Parabéns! Você economizou R$ " . number_format($reserva->calcularDesconto(), 2, ',', '.') . 
                        " com nosso desconto de estadia prolongada!
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