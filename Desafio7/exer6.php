<?php
class ConversorMoeda
{
    private string $moedaOrigem = 'BRL';
    private string $moedaDestino;
    private float $valorOriginal;
    private float $cotacao;

    // Símbolos e formatos por moeda
    private const FORMATOS = [
        'BRL' => ['symbol' => 'R$', 'decimals' => 2, 'locale' => 'pt-BR'],
        'USD' => ['symbol' => '$', 'decimals' => 2, 'locale' => 'en-US'],
        'EUR' => ['symbol' => '€', 'decimals' => 2, 'locale' => 'de-DE'],
    ];

    public function __construct(string $moedaDestino, float $valorOriginal, float $cotacao)
    {
        $this->moedaDestino = strtoupper($moedaDestino);
        $this->valorOriginal = $valorOriginal;
        $this->cotacao = $cotacao;
    }

    // Método principal: Realiza a conversão
    public function converter(): float
    {
        // Validação: cotação deve ser positiva
        if ($this->cotacao <= 0) {
            return 0;
        }
        
        // Conversão: Valor em BRL ÷ Cotação = Valor na moeda destino
        return $this->valorOriginal / $this->cotacao;
    }

    // Método auxiliar: Formata valor conforme moeda (formatação internacional)
    public function formatarValor(float $valor, string $moeda): string
    {
        $formato = self::FORMATOS[$moeda] ?? self::FORMATOS['BRL'];
        
        // Formatação manual compatível com qualquer servidor PHP
        $valorFormatado = number_format($valor, $formato['decimals'], '.', ',');
        
        // Para BRL: símbolo antes, para outras: símbolo antes também (padrão internacional)
        return "{$formato['symbol']} {$valorFormatado}";
    }

    // Método auxiliar: Retorna nome completo da moeda
    public function getNomeMoeda(string $codigo): string
    {
        switch ($codigo) {
            case 'BRL':
                return 'Real Brasileiro';
            case 'USD':
                return 'Dólar Americano';
            case 'EUR':
                return 'Euro';
            default:
                return $codigo;
        }
    }

    // Método auxiliar: Valida se moeda é suportada
    public function moedaSuportada(string $moeda): bool
    {
        return array_key_exists(strtoupper($moeda), self::FORMATOS);
    }

    // Método principal: Exibe resumo da conversão em HTML
    public function exibirResultado(): string
    {
        $valorConvertido = $this->converter();
        $origemFormatado = $this->formatarValor($this->valorOriginal, $this->moedaOrigem);
        $destinoFormatado = $this->formatarValor($valorConvertido, $this->moedaDestino);
        $nomeDestino = $this->getNomeMoeda($this->moedaDestino);

        return "
        <div style='background: #e8f5e9; padding: 15px; border-radius: 8px; border-left: 4px solid #4caf50;'>
            <h4 style='margin: 0 0 10px 0; color: #2e7d32;'>✅ Conversão Realizada</h4>
            <p style='margin: 5px 0;'><strong>Origem:</strong> {$origemFormatado} (BRL)</p>
            <p style='margin: 5px 0;'><strong>Cotação:</strong> 1 {$this->moedaDestino} = R$ " . number_format($this->cotacao, 4, ',', '.') . "</p>
            <p style='margin: 5px 0; font-size: 1.2em; color: #1b5e20;'>
                <strong>Resultado:</strong> {$destinoFormatado} <small>({$nomeDestino})</small>
            </p>
        </div>
        ";
    }

    // Getters
    public function getMoedaDestino(): string { return $this->moedaDestino; }
    public function getValorOriginal(): float { return $this->valorOriginal; }
    public function getCotacao(): float { return $this->cotacao; }
}
?>