<?php
class Produto
{
    private string $nome;
    private int $quantidadeEstoque;
    private float $valorUnitario;

    public function __construct(string $nome, int $quantidadeEstoque, float $valorUnitario)
    {
        $this->nome = $nome;
        $this->quantidadeEstoque = $quantidadeEstoque;
        $this->valorUnitario = $valorUnitario;
    }

    public function getResumo(): string
    {
        return "Produto: {$this->nome}, Valor Unitário: R$ " . number_format($this->valorUnitario, 2, ',', '.');
    }

    public function entradaEstoque(int $quantidade): bool
    {
        if ($quantidade > 0) {
            $this->quantidadeEstoque += $quantidade;
            return true;
        }
        return false;
    }

    public function saidaEstoque(int $quantidade): bool
    {
        if ($quantidade > 0 && $quantidade <= $this->quantidadeEstoque) {
            $this->quantidadeEstoque -= $quantidade;
            return true;
        }
        return false;
    }

    public function calcularValorTotalEstoque(): float
    {
        return $this->quantidadeEstoque * $this->valorUnitario;
    }

    public function verificarEstoqueBaixo(int $limite = 10): string
    {
        if ($this->quantidadeEstoque == 0) {
            return "🔴 Sem estoque!";
        } elseif ($this->quantidadeEstoque <= $limite) {
            return "🟡 Estoque baixo ({$this->quantidadeEstoque} un.)";
        } else {
            return "🟢 Estoque normal ({$this->quantidadeEstoque} un.)";
        }
    }

    public function exibirDetalhes(): string
    {
        return "
        <ul style='list-style: none; padding: 10px; background: #f9f9f9; border-radius: 8px;'>
            <li><strong>{$this->getResumo()}</strong></li>
            <li>Quantidade em Estoque: {$this->quantidadeEstoque} un.</li>
            <li>Valor Total em Estoque: R$ " . number_format($this->calcularValorTotalEstoque(), 2, ',', '.') . "</li>
            <li>Status: {$this->verificarEstoqueBaixo()}</li>
        </ul>
        ";
    }

    // Getters
    public function getNome(): string { return $this->nome; }
    public function getQuantidadeEstoque(): int { return $this->quantidadeEstoque; }
    public function getValorUnitario(): float { return $this->valorUnitario; }
}
?>