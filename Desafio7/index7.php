<?php require_once 'exer7.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planejador de Viagem</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; max-width: 700px; margin: 30px auto; padding: 20px; background: #f8f9fa; }
        .card { background: white; padding: 25px; border-radius: 16px; box-shadow: 0 8px 30px rgba(0,0,0,0.12); }
        h2 { color: #667eea; border-bottom: 3px solid #764ba2; padding-bottom: 12px; margin-top: 0; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 15px; }
        .form-group { margin: 12px 0; }
        label { display: block; margin-bottom: 6px; font-weight: 600; color: #333; font-size: 14px; }
        input, select { width: 100%; padding: 11px; border: 2px solid #e0e0e0; border-radius: 8px; box-sizing: border-box; font-size: 14px; transition: border-color 0.3s; }
        input:focus, select:focus { outline: none; border-color: #667eea; box-shadow: 0 0 0 3px rgba(102,126,234,0.15); }
        button { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 14px 20px; border: none; border-radius: 8px; cursor: pointer; font-size: 16px; width: 100%; margin-top: 15px; font-weight: bold; transition: transform 0.2s; }
        button:hover { transform: translateY(-2px); box-shadow: 0 5px 20px rgba(102,126,234,0.4); }
        .alert { padding: 14px; margin: 15px 0; border-radius: 8px; font-weight: 500; }
        .alert.error { background: #ffebee; color: #c62828; border-left: 4px solid #ef5350; }
        .dica { font-size: 12px; color: #666; margin-top: 4px; background: #f5f5f5; padding: 6px 10px; border-radius: 4px; }
        .consumo-personalizado { display: none; margin-top: 10px; padding: 12px; background: #f3e5f5; border-radius: 8px; border-left: 3px solid #9c27b0; }
        .consumo-personalizado.ativo { display: block; }
        hr { margin: 25px 0; border: none; border-top: 1px solid #eee; }
        @media (max-width: 600px) { .form-row { grid-template-columns: 1fr; } }
    </style>
    <script>
        // Mostra campo de consumo personalizado se selecionar "outro"
        document.addEventListener('DOMContentLoaded', function() {
            const tipoVeiculo = document.getElementById('tipoVeiculo');
            const consumoDiv = document.getElementById('consumoPersonalizadoDiv');
            const consumoInput = document.getElementById('consumoPersonalizado');
            
            tipoVeiculo.addEventListener('change', function() {
                if (this.value === 'outro') {
                    consumoDiv.classList.add('ativo');
                    consumoInput.required = true;
                } else {
                    consumoDiv.classList.remove('ativo');
                    consumoInput.required = false;
                    consumoInput.value = '';
                }
            });
        });
    </script>
</head>
<body>
    <div class="card">
        <h2>🗺️ Planejador de Viagem</h2>
        <p style="color: #666; margin-bottom: 20px;">Calcule velocidade, consumo e custos da sua viagem</p>
        
        <form method="post">
            <div class="form-row">
                <div class="form-group">
                    <label for="origem">📍 Origem:</label>
                    <input type="text" name="origem" id="origem" required placeholder="Ex: São Paulo">
                </div>
                <div class="form-group">
                    <label for="destino">🏁 Destino:</label>
                    <input type="text" name="destino" id="destino" required placeholder="Ex: Rio de Janeiro">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="distancia">📏 Distância (km):</label>
                    <input type="number" name="distancia" id="distancia" step="0.1" min="0.1" required placeholder="Ex: 430">
                </div>
                <div class="form-group">
                    <label for="tempo">⏱️ Tempo Estimado (horas):</label>
                    <input type="number" name="tempo" id="tempo" step="0.1" min="0.1" required placeholder="Ex: 5.5">
                    <div class="dica">💡 Use ponto para decimais: 2.5 = 2h30min</div>
                </div>
            </div>

            <div class="form-group">
                <label for="tipoVeiculo">🚗 Tipo de Veículo:</label>
                <select name="tipoVeiculo" id="tipoVeiculo" required>
                    <option value="">Selecione...</option>
                    <option value="carro_popular">🚗 Carro Popular (~12 km/l)</option>
                    <option value="carro_sedan">🚙 Carro Sedan (~10 km/l)</option>
                    <option value="suv">🚙 SUV (~8.5 km/l)</option>
                    <option value="moto">🏍️ Motocicleta (~25 km/l)</option>
                    <option value="caminhao">🚚 Caminhão (~3.5 km/l)</option>
                    <option value="eletrico">⚡ Carro Elétrico</option>
                    <option value="outro">⚙️ Outro (informar consumo)</option>
                </select>
            </div>

            <div id="consumoPersonalizadoDiv" class="consumo-personalizado">
                <label for="consumoPersonalizado">⛽ Consumo (km/l):</label>
                <input type="number" name="consumoPersonalizado" id="consumoPersonalizado" step="0.1" min="0.1" placeholder="Ex: 15.5">
                <div class="dica">Quantos km seu veículo faz com 1 litro?</div>
            </div>

            <div class="form-group">
                <label for="preco">💰 Preço do Combustível (R$/L):</label>
                <input type="number" name="preco" id="preco" step="0.01" min="0.01" required placeholder="Ex: 5.89">
                <div class="dica">Valor médio do litro na sua região</div>
            </div>

            <button type="submit">🚀 Calcular Viagem</button>
        </form>

        <hr>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Coleta e sanitiza dados
            $origem = trim($_POST['origem'] ?? '');
            $destino = trim($_POST['destino'] ?? '');
            $distancia = (float)($_POST['distancia'] ?? 0);
            $tempo = (float)($_POST['tempo'] ?? 0);
            $tipoVeiculo = $_POST['tipoVeiculo'] ?? '';
            $preco = (float)($_POST['preco'] ?? 0);
            $consumoPersonalizado = !empty($_POST['consumoPersonalizado']) 
                ? (float)$_POST['consumoPersonalizado'] 
                : null;
            
            $erro = "";

            // Validações com múltiplas rotas
         // Remova esta linha:
// } elseif (!in_array($tipoVeiculo, array_keys(Viagem::CONSUMO_POR_TIPO)) && $tipoVeiculo !== 'outro') {
//     $erro = "❌ Tipo de veículo inválido.";

// E mantenha apenas as validações essenciais:
if (empty($origem) || empty($destino)) {
    $erro = "❌ Origem e destino são obrigatórios.";
} elseif ($distancia <= 0) {
    $erro = "❌ A distância deve ser maior que zero.";
} elseif ($tempo <= 0) {
    $erro = "❌ O tempo estimado deve ser maior que zero.";
} elseif ($preco <= 0) {
    $erro = "❌ O preço do combustível deve ser positivo.";
} elseif ($tipoVeiculo === 'outro' && (!$consumoPersonalizado || $consumoPersonalizado <= 0)) {
    $erro = "❌ Informe o consumo do veículo para a opção 'Outro'.";
} else {
                // ✅ Tudo válido: instancia e exibe
                $viagem = new Viagem(
                    $origem,
                    $destino,
                    $distancia,
                    $tempo,
                    $tipoVeiculo,
                    $preco,
                    $consumoPersonalizado
                );
                echo $viagem->exibirDetalhes();
                
                // Dica extra baseada no resultado
                $custoKm = $viagem->calcularCustoPorKm();
                if ($custoKm > 0.8) {
                    echo "<div class='alert' style='background:#fff3e0;color:#e65100;border-left:4px solid #ff9800'>
                        💡 <strong>Dica:</strong> Custo por km elevado! Considere carona solidária ou veículo mais econômico.
                    </div>";
                } elseif ($viagem->calcularVelocidadeMedia() > 100) {
                    echo "<div class='alert' style='background:#e3f2fd;color:#1565c0;border-left:4px solid #2196f3'>
                        ⚠️ <strong>Atenção:</strong> Velocidade média alta. Respeite os limites e dirija com segurança!
                    </div>";
                }
            }

            if ($erro) {
                echo "<div class='alert error'>{$erro}</div>";
            }
        }
        ?>

        <button onclick="window.location.href='indexprinci.php'" 
                style="background: #6c757d; margin-top: 15px;">
            ← Voltar ao Menu
        </button>
    </div>
</body>
</html>