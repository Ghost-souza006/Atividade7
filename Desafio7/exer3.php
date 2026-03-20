<?php
class Pedido
{
    private string $nomeProduto;
    private int $quantidade;
    private float $precoUnitario;
    private string $tipoDeCliente;

    public function __construct(string $nomeProduto, int $quantidade, float $precoUnitario, string $tipoDeCliente)
    {
        $this->nomeProduto = $nomeProduto;
        $this->quantidade = $quantidade;
        $this->precoUnitario = $precoUnitario;
        $this->tipoDeCliente = $tipoDeCliente;
    }

    function calcularTotalBruto()
    {
        return $this->quantidade * $this->precoUnitario;
    }

    function calcularDesconto()
    {
        if ($this->tipoDeCliente == 'premium') {
            return $this->calcularTotalBruto() * 0.10; // 10% de desconto
        }
        return 0;
    }

    function calcularImposto()
    {
        return $this->calcularTotalBruto() * 0.08; // 8% de imposto
    }

    function calcularTotalFinal()
    {
        return $this->calcularTotalBruto() - $this->calcularDesconto() + $this->calcularImposto();
    }

    function exibirDetalhes()
    {
        return "
        <ul>
            <li>Produto: {$this->nomeProduto}</li>
            <li>Quantidade: {$this->quantidade}</li>
            <li>Preço Unitário: R$ " . number_format($this->precoUnitario, 2, ',', '.') . "</li>
            <li>Tipo de Cliente: " . ucfirst($this->tipoDeCliente) . "</li>
            <li>Total Bruto: R$ " . number_format($this->calcularTotalBruto(), 2, ',', '.') . "</li>
            <li>Desconto: R$ " . number_format($this->calcularDesconto(), 2, ',', '.') . "</li>
            <li>Imposto (8%): R$ " . number_format($this->calcularImposto(), 2, ',', '.') . "</li>
            <li><strong>Total Final: R$ " . number_format($this->calcularTotalFinal(), 2, ',', '.') . "</strong></li>
        </ul>
        ";
    }
}
?>