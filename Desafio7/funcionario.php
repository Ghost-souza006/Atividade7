<?php
class Funcionario {
    private string $nome;
    private string $cargo;
    private float $salario;
    private int $cargaHoraria;


    public function __construct($nome, $cargo, $salario, $cargaHoraria) {
        $this->nome = $nome;
        $this->cargo = $cargo;
        $this->salario = $salario;
        $this->cargaHoraria = $cargaHoraria;
    }


    public function getResumo(){
        return "Funcionário: {$this->nome}, Cargo: {$this->cargo}";
    }


    public function calcularValorHora(){
        return $this->salario / ($this->cargaHoraria * 4); // por mês
    }


    public function calcularSalarioComBonus(float $bonus){
        return $this->salario + $bonus;
    }


    public function calcularHoraExtra(int $horasExtras){
        return $this->calcularValorHora() * 1.5 * $horasExtras;
    }


    public function exibirDetalhes(float $bonus, int $horasExtras){
        $salarioFinal = $this->salario + $this->calcularHoraExtra($horasExtras) + $bonus;


        return "
        <ul>
            <li>{$this->getResumo()}</li>
            <li>Salário base: R$ " . number_format($this->salario, 2, ',', '.') . "</li>
            <li>Valor da hora: R$ " . number_format($this->calcularValorHora(), 2, ',', '.') . "</li>
            <li>Hora extra ({$horasExtras}h): R$ " . number_format($this->calcularHoraExtra($horasExtras), 2, ',', '.') . "</li>
            <li>Bônus: R$ " . number_format($bonus, 2, ',', '.') . "</li>
            <li><strong>Salário final: R$ " . number_format($salarioFinal, 2, ',', '.') . "</strong></li>
        </ul>
        ";
    }
}
?>
