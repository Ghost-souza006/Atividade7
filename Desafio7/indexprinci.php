<?php
// indexprinci.php - Menu Principal de Exercícios POO em PHP
session_start();

// Lista completa de exercícios disponíveis
$exercicios = [
    // 📚 BÁSICO
    [
        'id' => 1,
        'titulo' => '👨‍🎓 Classe Aluno',
        'descricao' => 'Média das notas, situação (Aprovado/Recuperação/Reprovado) e resumo',
        'arquivo' => 'index2.php',
        'categoria' => 'Básico',
        'icone' => '🎓',
        'cor' => '#4caf50'
    ],
    [
        'id' => 2,
        'titulo' => '🛒 Classe Pedido',
        'descricao' => 'Cálculo de total, desconto premium, imposto e valor final do pedido',
        'arquivo' => 'index3.php',
        'categoria' => 'Básico',
        'icone' => '🛒',
        'cor' => '#2196f3'
    ],
    [
        'id' => 3,
        'titulo' => '💼 Classe Funcionário',
        'descricao' => 'Salário, hora extra, bônus e cálculo do valor por hora trabalhada',
        'arquivo' => 'index.php',
        'categoria' => 'Básico',
        'icone' => '💼',
        'cor' => '#9c27b0'
    ],
    
    // 🚀 INTERMEDIÁRIO
    [
        'id' => 4,
        'titulo' => '🚗 Classe Carro',
        'descricao' => 'Autonomia, custo/km, consumo médio e controle de revisão',
        'arquivo' => 'index4.php',
        'categoria' => 'Intermediário',
        'icone' => '🚗',
        'cor' => '#ff9800'
    ],
    [
        'id' => 5,
        'titulo' => '📦 Classe Produto',
        'descricao' => 'Controle de estoque: entrada, saída e valor total em estoque',
        'arquivo' => 'index5.php',
        'categoria' => 'Intermediário',
        'icone' => '📦',
        'cor' => '#795548'
    ],
    [
        'id' => 6,
        'titulo' => '💱 ConversorMoeda',
        'descricao' => 'Conversão BRL → USD/EUR com formatação internacional',
        'arquivo' => 'index6.php',
        'categoria' => 'Intermediário',
        'icone' => '💱',
        'cor' => '#009688'
    ],
    
    // 🎯 AVANÇADO
    [
        'id' => 7,
        'titulo' => '🗺️ Classe Viagem',
        'descricao' => 'Planejamento: velocidade média, consumo estimado e custos da viagem',
        'arquivo' => 'index7.php',
        'categoria' => 'Avançado',
        'icone' => '🗺️',
        'cor' => '#3f51b5'
    ],
    [
        'id' => 8,
        'titulo' => '🧮 CalculadoraFinanceira',
        'descricao' => 'Parcelamento com juros compostos, total e diferença de valores',
        'arquivo' => 'index8.php',
        'categoria' => 'Avançado',
        'icone' => '🧮',
        'cor' => '#607d8b'
    ],
    [
        'id' => 9,
        'titulo' => '🧍 Classe Pessoa (IMC)',
        'descricao' => 'Cálculo do IMC e classificação conforme padrão da OMS',
        'arquivo' => 'index9.php',
        'categoria' => 'Avançado',
        'icone' => '⚖️',
        'cor' => '#e91e63'
    ],
    [
        'id' => 10,
        'titulo' => '🏨 ReservaHotel',
        'descricao' => 'Simulação de diária com desconto para estadias prolongadas',
        'arquivo' => 'index10.php',
        'categoria' => 'Avançado',
        'icone' => '🛏️',
        'cor' => '#ff5722'
    ],
    [
        'id' => 11,
        'titulo' => '📐 CalculadoraGeometrica',
        'descricao' => 'Área de figuras: quadrado, retângulo e círculo com fórmulas',
        'arquivo' => 'index11.php',
        'categoria' => 'Avançado',
        'icone' => '🔷',
        'cor' => '#00bcd4'
    ],
];

// Agrupa exercícios por categoria
$categorias = ['Básico', 'Intermediário', 'Avançado'];
$totalExercicios = count($exercicios);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🎓 Painel de Exercícios - POO em PHP</title>
    <link rel="stylesheet" href="styleindex.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>🎓 Exercícios de POO em PHP</h1>
            <p>Pratique programação orientada a objetos com projetos reais</p>
            <div class="stats">
                <div class="stat">📚 <?= $totalExercicios ?> Exercícios</div>
                <div class="stat">🗂️ <?= count($categorias) ?> Níveis</div>
                <div class="stat">✅ 100% Funcional</div>
            </div>
        </header>

        <?php foreach ($categorias as $categoria): ?>
            <section class="categoria-section">
                <h2 class="categoria-title">
                    <?= $categoria === 'Básico' ? '🌱' : ($categoria === 'Intermediário' ? '🚀' : '🎯') ?>
                    <?= htmlspecialchars($categoria) ?>
                </h2>
                <div class="grid">
                    <?php foreach ($exercicios as $ex): ?>
                        <?php if ($ex['categoria'] === $categoria): ?>
                            <a href="<?= htmlspecialchars($ex['arquivo']) ?>" 
                               class="card" 
                               style="--cor: <?= $ex['cor'] ?>;">
                                <div class="card-header">
                                    <span class="card-icon"><?= $ex['icone'] ?></span>
                                    <h3><?= htmlspecialchars($ex['titulo']) ?></h3>
                                    <span class="card-badge">Ex <?= $ex['id'] ?></span>
                                </div>
                                <p><?= htmlspecialchars($ex['descricao']) ?></p>
                                <div class="card-footer">
                                    <span><?= basename($ex['arquivo']) ?></span>
                                    <span class="arrow">→</span>
                                </div>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endforeach; ?>

        <footer>
            <p>💻 Desenvolvido para aprendizado de POO em PHP</p>
            <p class="mt-10">
                <a href="#" onclick="window.location.reload()">🔄 Recarregar</a> 
                • 
                <a href="https://www.php.net/manual/pt_BR/language.oop5.php" target="_blank">📖 Documentação PHP</a>
            </p>
        </footer>
    </div>

    <script>
     function handleClick() {
    console.log('Card clicado');
}

document.querySelectorAll('.card').forEach(card => {
    card.addEventListener('click', handleClick);
});