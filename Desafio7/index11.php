<?php require_once 'exer11.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Geométrica</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Estilos específicos para campos dinâmicos */
        .campo-medida { display: none; }
        .campo-medida.ativo { display: block; }
        .preview-formula { 
            background: #f3e5f5; 
            padding: 10px; 
            border-radius: 6px; 
            margin: 10px 0; 
            font-family: monospace;
            color: #4a148c;
        }
    </style>
    <script>
        // Mostra/esconde campos conforme tipo de figura
        document.addEventListener('DOMContentLoaded', function() {
            const tipoFigura = document.getElementById('tipoFigura');
            const campoLado = document.getElementById('campoLado');
            const campoBase = document.getElementById('campoBase');
            const campoAltura = document.getElementById('campoAltura');
            const campoRaio = document.getElementById('campoRaio');
            const preview = document.getElementById('previewFormula');
            
            function atualizarCampos() {
                const tipo = tipoFigura.value;
                
                // Esconde todos primeiro
                campoLado.classList.remove('ativo');
                campoBase.classList.remove('ativo');
                campoAltura.classList.remove('ativo');
                campoRaio.classList.remove('ativo');
                
                // Mostra conforme seleção + atualiza preview
                if (tipo === 'quadrado') {
                    campoLado.classList.add('ativo');
                    document.getElementById('medida1').required = true;
                    document.getElementById('medida2').required = false;
                    preview.textContent = '📐 Fórmula: lado²';
                } else if (tipo === 'retangulo') {
                    campoBase.classList.add('ativo');
                    campoAltura.classList.add('ativo');
                    document.getElementById('medida1').required = true;
                    document.getElementById('medida2').required = true;
                    preview.textContent = '📐 Fórmula: base × altura';
                } else if (tipo === 'circulo') {
                    campoRaio.classList.add('ativo');
                    document.getElementById('medida1').required = true;
                    document.getElementById('medida2').required = false;
                    preview.textContent = '📐 Fórmula: π × raio²';
                } else {
                    document.getElementById('medida1').required = false;
                    document.getElementById('medida2').required = false;
                    preview.textContent = '';
                }
            }
            
            tipoFigura.addEventListener('change', atualizarCampos);
            atualizarCampos(); // inicializa
        });
    </script>
</head>
<body>
    <div class="card-form">
        <h2>📐 Calculadora de Áreas</h2>
        
        <form method="post">
            <div class="form-group">
                <label for="tipoFigura">🔷 Escolha a Figura:</label>
                <select name="tipoFigura" id="tipoFigura" required>
                    <option value="">Selecione...</option>
                    <option value="quadrado">🔷 Quadrado</option>
                    <option value="retangulo">🔶 Retângulo</option>
                    <option value="circulo">⭕ Círculo</option>
                </select>
            </div>

            <!-- Campo: Lado (Quadrado) -->
            <div class="form-group campo-medida" id="campoLado">
                <label for="medida1">📏 Lado:</label>
                <input type="number" name="medida1" id="medida1" step="0.01" min="0.01" placeholder="Ex: 5">
            </div>

            <!-- Campos: Base e Altura (Retângulo) -->
            <div class="form-row">
                <div class="form-group campo-medida" id="campoBase">
                    <label for="medida1">📐 Base:</label>
                    <input type="number" name="medida1" id="medida1" step="0.01" min="0.01" placeholder="Ex: 8">
                </div>
                <div class="form-group campo-medida" id="campoAltura">
                    <label for="medida2">📐 Altura:</label>
                    <input type="number" name="medida2" id="medida2" step="0.01" min="0.01" placeholder="Ex: 4">
                </div>
            </div>

            <!-- Campo: Raio (Círculo) -->
            <div class="form-group campo-medida" id="campoRaio">
                <label for="medida1">⭕ Raio:</label>
                <input type="number" name="medida1" id="medida1" step="0.01" min="0.01" placeholder="Ex: 3.5">
            </div>

            <div class="preview-formula" id="previewFormula"></div>
            
            <div class="dica">
                💡 Todas as medidas em mesma unidade. Resultado em unidades².
            </div>

            <button type="submit" class="btn-primary">🧮 Calcular Área</button>
        </form>

        <hr class="mt-20">

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipoFigura = strtolower(trim($_POST['tipoFigura'] ?? ''));
            $medida1 = (float)($_POST['medida1'] ?? 0);
            $medida2 = (float)($_POST['medida2'] ?? 0);
            
            $erro = "";

            // Validações
            if (!in_array($tipoFigura, ['quadrado', 'retangulo', 'circulo'])) {
                $erro = "❌ Selecione um tipo de figura válido.";
            } elseif ($medida1 <= 0) {
                $erro = "❌ A primeira medida deve ser maior que zero.";
            } elseif ($tipoFigura === 'retangulo' && $medida2 <= 0) {
                $erro = "❌ Para retângulo, ambas as medidas são obrigatórias.";
            } else {
                // Instancia a classe e exibe resultado
                $calc = new CalculadoraGeometrica($tipoFigura, $medida1, $medida2);
                echo "<h3>✅ Resultado:</h3>";
                echo $calc->exibirDetalhes();
                
                // Mensagem contextual
                $area = $calc->calcularArea();
                if ($area > 100) {
                    echo "<div class='alert info'>
                        📊 Área grande! Considere usar unidades menores para maior precisão.
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