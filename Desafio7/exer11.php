<?php
class CalculadoraGeometrica
{
    private string $tipoFigura;
    private float $medida1;
    private float $medida2; // opcional (para retângulo)

    public function __construct(string $tipoFigura, float $medida1, float $medida2 = 0)
    {
        $this->tipoFigura = strtolower($tipoFigura);
        $this->medida1 = $medida1;
        $this->medida2 = $medida2;
    }

    // Método auxiliar: Calcula a área usando switch (habilidade solicitada)
    function calcularArea()
    {
        switch ($this->tipoFigura) {
            case 'quadrado':
                // Área = lado²
                return $this->medida1 * $this->medida1;
                
            case 'retangulo':
                // Área = base × altura
                return $this->medida1 * $this->medida2;
                
            case 'circulo':
                // Área = π × raio²
                return M_PI * $this->medida1 * $this->medida1;
                
            default:
                return 0;
        }
    }

    // Método auxiliar: Retorna nome formatado da figura
    function getNomeFigura()
    {
        switch ($this->tipoFigura) {
            case 'quadrado':
                return "🔷 Quadrado";
            case 'retangulo':
                return "🔶 Retângulo";
            case 'circulo':
                return "⭕ Círculo";
            default:
                return "❓ Figura desconhecida";
        }
    }

    // Método auxiliar: Retorna fórmula usada no cálculo
    function getFormula()
    {
        switch ($this->tipoFigura) {
            case 'quadrado':
                return "lado² = {$this->medida1} × {$this->medida1}";
            case 'retangulo':
                return "base × altura = {$this->medida1} × {$this->medida2}";
            case 'circulo':
                return "π × raio² = 3.14159 × {$this->medida1}²";
            default:
                return "Fórmula não disponível";
        }
    }

    // Método principal: Exibe detalhes em lista HTML (padrão dos exercícios)
    function exibirDetalhes()
    {
        return "
        <ul>
            <li>Figura: {$this->getNomeFigura()}</li>
            <li>Fórmula: {$this->getFormula()}</li>
            <li><strong>🎯 Área Calculada: " . number_format($this->calcularArea(), 2, ',', '.') . "</strong></li>
        </ul>
        ";
    }
}
?>