<?php
class Pessoa
{
    private string $nome;
    private float $peso;
    private float $altura;

    public function __construct(string $nome, float $peso, float $altura)
    {
        $this->nome = $nome;
        $this->peso = $peso;
        $this->altura = $altura;
    }

    // Método auxiliar: Calcula o IMC (peso / altura²)
    function calcularIMC()
    {
        if ($this->altura <= 0) {
            return 0;
        }
        return $this->peso / ($this->altura * $this->altura);
    }

    // Método auxiliar: Classifica o IMC conforme padrão OMS
    function classificarIMC()
    {
        $imc = $this->calcularIMC();
        
        if ($imc < 18.5) {
            return "🟡 Abaixo do peso";
        } elseif ($imc < 25) {
            return "🟢 Peso normal";
        } elseif ($imc < 30) {
            return "🟠 Sobrepeso";
        } elseif ($imc < 35) {
            return "🔴 Obesidade grau I";
        } elseif ($imc < 40) {
            return "🔴 Obesidade grau II";
        } else {
            return "⚫ Obesidade grau III";
        }
    }

    // Método auxiliar: Retorna faixa de peso ideal (sugestão)
    function getPesoIdeal()
    {
        // IMC normal: 18.5 a 24.9
        $min = 18.5 * ($this->altura * $this->altura);
        $max = 24.9 * ($this->altura * $this->altura);
        return number_format($min, 1, ',', '.') . " a " . number_format($max, 1, ',', '.') . " kg";
    }

    // Método principal: Exibe detalhes em lista HTML (padrão dos exercícios)
    function exibirDetalhes()
    {
        return "
        <ul>
            <li>Nome: {$this->nome}</li>
            <li>Peso: " . number_format($this->peso, 1, ',', '.') . " kg</li>
            <li>Altura: " . number_format($this->altura, 2, ',', '.') . " m</li>
            <li><strong>IMC: " . number_format($this->calcularIMC(), 1, ',', '.') . "</strong></li>
            <li>Classificação: {$this->classificarIMC()}</li>
            <li>Peso ideal sugerido: {$this->getPesoIdeal()}</li>
        </ul>
        ";
    }
}
?>