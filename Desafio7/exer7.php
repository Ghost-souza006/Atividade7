<?php
class Viagem
{
    private string $origem;
    private string $destino;
    private float $distanciaKm;
    private float $tempoHoras;
    private string $tipoVeiculo;
    private float $consumoVeiculo; // km/l
    private float $precoCombustivel;

    // Consumo médio por tipo de veículo (km/l) - valores de referência
    private const CONSUMO_POR_TIPO = [
        'carro_popular' => 12.0,
        'carro_sedan'   => 10.0,
        'suv'           => 8.5,
        'moto'          => 25.0,
        'caminhao'      => 3.5,
        'eletrico'      => 0.0  // Consumo em kWh/km (tratamento especial)
    ];

    public function __construct(
        string $origem,
        string $destino,
        float $distanciaKm,
        float $tempoHoras,
        string $tipoVeiculo,
        float $precoCombustivel,
        ?float $consumoPersonalizado = null
    ) {
        $this->origem = $origem;
        $this->destino = $destino;
        $this->distanciaKm = $distanciaKm;
        $this->tempoHoras = $tempoHoras;
        $this->tipoVeiculo = strtolower($tipoVeiculo);
        $this->precoCombustivel = $precoCombustivel;
        
        // Usa consumo personalizado ou busca no catálogo
        $this->consumoVeiculo = $consumoPersonalizado ?? 
                                (self::CONSUMO_POR_TIPO[$this->tipoVeiculo] ?? 10.0);
    }

    // 🔁 Método reutilizável: Calcula velocidade média (km/h)
    public function calcularVelocidadeMedia(): float
    {
        if ($this->tempoHoras <= 0) {
            return 0;
        }
        return $this->distanciaKm / $this->tempoHoras;
    }

    // 🔁 Método reutilizável: Calcula consumo estimado de combustível (litros)
    public function calcularConsumoEstimado(): float
    {
        // Veículo elétrico não consome combustível líquido
        if ($this->tipoVeiculo === 'eletrico' || $this->consumoVeiculo <= 0) {
            return 0;
        }
        return $this->distanciaKm / $this->consumoVeiculo;
    }

    // 🔁 Método reutilizável: Calcula custo total da viagem
    public function calcularCustoViagem(): float
    {
        $litros = $this->calcularConsumoEstimado();
        return $litros * $this->precoCombustivel;
    }

    // 🔁 Método reutilizável: Calcula custo por quilômetro
    public function calcularCustoPorKm(): float
    {
        if ($this->distanciaKm <= 0) {
            return 0;
        }
        return $this->calcularCustoViagem() / $this->distanciaKm;
    }

    // Método auxiliar: Retorna nome amigável do veículo
    public function getNomeVeiculo(): string
    {
        $nomes = [
            'carro_popular' => '🚗 Carro Popular',
            'carro_sedan'   => '🚙 Carro Sedan',
            'suv'           => '🚙 SUV',
            'moto'          => '🏍️ Motocicleta',
            'caminhao'      => '🚚 Caminhão',
            'eletrico'      => '⚡ Carro Elétrico'
        ];
        return $nomes[$this->tipoVeiculo] ?? '🚗 Veículo';
    }

    // Método auxiliar: Formata tempo em formato legível (ex: 2h 30min)
    public function formatarTempo(float $horas): string
    {
        $h = floor($horas);
        $m = round(($horas - $h) * 60);
        $partes = [];
        if ($h > 0) $partes[] = "{$h}h";
        if ($m > 0) $partes[] = "{$m}min";
        return implode(' ', $partes) ?: '0min';
    }

    // 🎯 Método principal: Exibe todos os detalhes em HTML
    public function exibirDetalhes(): string
    {
        $velocidade = $this->calcularVelocidadeMedia();
        $consumo = $this->calcularConsumoEstimado();
        $custoTotal = $this->calcularCustoViagem();
        $custoKm = $this->calcularCustoPorKm();

        // Mensagem especial para elétrico
        $infoCombustivel = $this->tipoVeiculo === 'eletrico' 
            ? "⚡ Energia: Consumo em kWh (não calculado)" 
            : "⛽ Consumo: " . number_format($consumo, 2, ',', '.') . " L";

        return "
        <div style='background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
                    color: white; padding: 20px; border-radius: 12px; margin: 15px 0;'>
            <h3 style='margin: 0 0 15px 0; text-align: center;'>🗺️ Resumo da Viagem</h3>
            
            <div style='background: rgba(255,255,255,0.15); padding: 12px; border-radius: 8px; margin-bottom: 10px;'>
                <strong>📍 Trajeto:</strong><br>
                {$this->origem} → {$this->destino}
            </div>
            
            <div style='display: grid; grid-template-columns: 1fr 1fr; gap: 10px;'>
                <div>
                    <p style='margin: 5px 0;'><strong>🚗 Veículo:</strong><br>
                    {$this->getNomeVeiculo()}</p>
                    <p style='margin: 5px 0;'><strong>📏 Distância:</strong><br>
                    " . number_format($this->distanciaKm, 1, ',', '.') . " km</p>
                    <p style='margin: 5px 0;'><strong>⏱️ Tempo Estimado:</strong><br>
                    {$this->formatarTempo($this->tempoHoras)}</p>
                </div>
                <div>
                    <p style='margin: 5px 0;'><strong>💨 Velocidade Média:</strong><br>
                    " . number_format($velocidade, 1, ',', '.') . " km/h</p>
                    <p style='margin: 5px 0;'><strong>{$infoCombustivel}</strong></p>
                    <p style='margin: 5px 0;'><strong>💰 Preço Combustível:</strong><br>
                    R$ " . number_format($this->precoCombustivel, 2, ',', '.') . "/L</p>
                </div>
            </div>
            
            <hr style='border-color: rgba(255,255,255,0.3); margin: 15px 0;'>
            
            <div style='text-align: center;'>
                <p style='font-size: 1.3em; margin: 10px 0;'>
                    💵 <strong>Custo Total Estimado:</strong><br>
                    <span style='font-size: 1.8em; color: #ffd54f;'>
                        R$ " . number_format($custoTotal, 2, ',', '.') . "
                    </span>
                </p>
                <p style='margin: 5px 0; opacity: 0.9;'>
                    (R$ " . number_format($custoKm, 3, ',', '.') . " por km rodado)
                </p>
            </div>
        </div>
        ";
    }

    // Getters para acesso externo
    public function getOrigem(): string { return $this->origem; }
    public function getDestino(): string { return $this->destino; }
    public function getDistanciaKm(): float { return $this->distanciaKm; }
    public function getTempoHoras(): float { return $this->tempoHoras; }
    public function getTipoVeiculo(): string { return $this->tipoVeiculo; }
    public function getConsumoVeiculo(): float { return $this->consumoVeiculo; }
    public function getPrecoCombustivel(): float { return $this->precoCombustivel; }
}
?>