<?php
class Carro
{
    private string $modelo;
    private string $combustivel;
    private float $tanqueCheio;
    private float $consumo; // km/l
    private float $kmRodados;
    private float $precoCombustivel;

    public function __construct($modelo, $combustivel, $tanqueCheio, $consumo, $kmRodados, $precoCombustivel)
    {
        $this->modelo = $modelo;
        $this->combustivel = $combustivel;
        $this->tanqueCheio = $tanqueCheio;
        $this->consumo = $consumo;
        $this->kmRodados = $kmRodados;
        $this->precoCombustivel = $precoCombustivel;
    }

    // Método auxiliar: Retorna resumo básico
    function getResumo()
    {
        return "Carro: {$this->modelo}, Combustível: {$this->combustivel}";
    }

    // Método auxiliar: Calcula Autonomia (Tanque * Consumo)
    function calcularAutonomia()
    {
        return $this->tanqueCheio * $this->consumo;
    }

    // Método auxiliar: Calcula Custo por KM (Preço / Consumo)
    function calcularCustoPorKm()
    {
        if ($this->consumo == 0) {
            return 0;
        }
        return $this->precoCombustivel / $this->consumo;
    }

    // Método auxiliar: Verifica Revisão (Limite de 10.000 km)
    function verificarRevisao()
    {
        if ($this->kmRodados >= 10000) {
            return "⚠️ Hora da Revisão!";
        } else {
            $faltam = 10000 - $this->kmRodados;
            return "✅ Em dia (Faltam " . number_format($faltam, 0, ',', '.') . " km)";
        }
    }

    // Método principal: Exibe todos os detalhes em lista HTML
    function exibirDetalhes()
    {
        return "
        <ul>
        <li>{$this->getResumo()}</li>
        <li>Tanque: {$this->tanqueCheio} L | Consumo: {$this->consumo} km/l</li>
        <li>Km Rodados: " . number_format($this->kmRodados, 0, ',', '.') . " km</li>
        <li>Autonomia Máxima: " . number_format($this->calcularAutonomia(), 2, ',', '.') . " km</li>
        <li>Custo por KM: R$ " . number_format($this->calcularCustoPorKm(), 2, ',', '.') . "</li>
        <li>Status Revisão: {$this->verificarRevisao()}</li>
        </ul>
        ";
    }
}
?>