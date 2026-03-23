<?php
class CalculadoraFinanceira
{
    private float $valorCompra;
    private int $numeroParcelas;
    private float $taxaJurosMensal; // em decimal (ex: 0.02 = 2%)

    public function __construct(float $valorCompra, int $numeroParcelas, float $taxaJurosMensal)
    {
        $this->valorCompra = $valorCompra;
        $this->numeroParcelas = $numeroParcelas;
        $this->taxaJurosMensal = $taxaJurosMensal;
    }

    // Calcula o TOTAL com juros compostos: Valor * (1 + taxa) ^ n
    function calcularTotalComJuros()
    {
        if ($this->taxaJurosMensal < 0 || $this->numeroParcelas <= 0) {
            return $this->valorCompra;
        }
        return $this->valorCompra * pow(1 + $this->taxaJurosMensal, $this->numeroParcelas);
    }

    // Calcula o valor de CADA parcela
    function calcularValorParcela()
    {
        if ($this->numeroParcelas <= 0) {
            return 0;
        }
        return $this->calcularTotalComJuros() / $this->numeroParcelas;
    }

    // Calcula o total de JUROS pagos
    function calcularJurosPagos()
    {
        return $this->calcularTotalComJuros() - $this->valorCompra;
    }

    // Calcula porcentagem de juros sobre o valor original
    function calcularPorcentagemJuros()
    {
        if ($this->valorCompra <= 0) {
            return 0;
        }
        return ($this->calcularJurosPagos() / $this->valorCompra) * 100;
    }

    // Método principal: Exibe detalhes em lista HTML (padrão dos outros exercícios)
    function exibirDetalhes()
    {
        return "
        <ul>
            <li>Valor da Compra: R$ " . number_format($this->valorCompra, 2, ',', '.') . "</li>
            <li>Número de Parcelas: {$this->numeroParcelas}x</li>
            <li>Taxa de Juros: " . number_format($this->taxaJurosMensal * 100, 2, ',', '.') . "% ao mês</li>
            <li>Valor de cada Parcela: R$ " . number_format($this->calcularValorParcela(), 2, ',', '.') . "</li>
            <li>Total a Pagar: R$ " . number_format($this->calcularTotalComJuros(), 2, ',', '.') . "</li>
            <li>Juros Pagos: R$ " . number_format($this->calcularJurosPagos(), 2, ',', '.') . "</li>
            <li><strong>Custo Extra: " . number_format($this->calcularPorcentagemJuros(), 2, ',', '.') . "%</strong></li>
        </ul>
        ";
    }
}
?>