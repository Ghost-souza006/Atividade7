<?php
class ReservaHotel
{
    private string $nomeHospede;
    private int $numeroNoites;
    private string $tipoQuarto;
    
    // Preços por tipo de quarto (por noite)
    private const PRECOS = [
        'simples' => 120.00,
        'luxo'    => 200.00,
        'suite'   => 350.00
    ];

    public function __construct(string $nomeHospede, int $numeroNoites, string $tipoQuarto)
    {
        $this->nomeHospede = $nomeHospede;
        $this->numeroNoites = $numeroNoites;
        $this->tipoQuarto = strtolower($tipoQuarto);
    }

    // Método auxiliar: Retorna preço da diária conforme tipo de quarto
    function getPrecoDiaria()
    {
        // Usa switch para selecionar preço (habilidade solicitada)
        switch ($this->tipoQuarto) {
            case 'simples':
                return self::PRECOS['simples'];
            case 'luxo':
                return self::PRECOS['luxo'];
            case 'suite':
                return self::PRECOS['suite'];
            default:
                return self::PRECOS['simples']; // fallback
        }
    }

    // Método auxiliar: Calcula valor bruto (sem desconto)
    function calcularTotalBruto()
    {
        return $this->getPrecoDiaria() * $this->numeroNoites;
    }

    // Método auxiliar: Calcula desconto para estadias longas
    function calcularDesconto()
    {
        // Desconto progressivo conforme número de noites
        if ($this->numeroNoites >= 10) {
            return $this->calcularTotalBruto() * 0.15; // 15% off
        } elseif ($this->numeroNoites >= 5) {
            return $this->calcularTotalBruto() * 0.10; // 10% off
        }
        return 0; // sem desconto
    }

    // Método auxiliar: Calcula valor final com desconto
    function calcularTotalFinal()
    {
        return $this->calcularTotalBruto() - $this->calcularDesconto();
    }

    // Método auxiliar: Retorna mensagem de boas-vindas personalizada
    function getMensagemBoasVindas()
    {
        $quartoNome = ucfirst($this->tipoQuarto);
        $descontoInfo = $this->calcularDesconto() > 0 
            ? "🎁 Você ganhou " . number_format($this->calcularDesconto()/100, 0) . "% de desconto por ficar {$this->numeroNoites} noites!" 
            : "💡 Dica: Fique 5+ noites e ganhe 10% de desconto!";
        
        return "✨ Bem-vindo(a), {$this->nomeHospede}! Seu quarto {$quartoNome} está reservado. {$descontoInfo}";
    }

    // Método principal: Exibe detalhes em lista HTML (padrão dos exercícios)
    function exibirDetalhes()
    {
        return "
        <ul>
            <li>Hóspede: {$this->nomeHospede}</li>
            <li>Tipo de Quarto: " . ucfirst($this->tipoQuarto) . " (R$ " . number_format($this->getPrecoDiaria(), 2, ',', '.') . "/noite)</li>
            <li>Número de Noites: {$this->numeroNoites}</li>
            <li>Valor Bruto: R$ " . number_format($this->calcularTotalBruto(), 2, ',', '.') . "</li>
            <li>Desconto: - R$ " . number_format($this->calcularDesconto(), 2, ',', '.') . "</li>
            <li><strong>🎯 Total Final: R$ " . number_format($this->calcularTotalFinal(), 2, ',', '.') . "</strong></li>
            <li><em>{$this->getMensagemBoasVindas()}</em></li>
        </ul>
        ";
    }
}
?>