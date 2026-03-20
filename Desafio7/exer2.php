<?php
class Aluno
{
    private string $nome;
    private string $disciplina;
    private float $nota;
    private float $nota2;
    private float $nota3;
    public function __construct($nome, $disciplina, $nota, $nota2, $nota3)
    {
        $this->nome = $nome;
        $this->disciplina = $disciplina;
        $this->nota = $nota;
        $this->nota2 = $nota2;
        $this->nota3 = $nota3;
    }
    function getResumo()
    {
        return "Aluno: {$this->nome}, Disciplina: {$this->disciplina}, nota: {$this->nota}  ";
    }
    function calcularNota()
    {
        if ($this->nota >= 7) {
            return "Aprovado";
        } elseif ($this->nota >= 5) {
            return "Recuperação";
        } else {
            return "Reprovado";
        }
    }
    function calcularMedia()
    {
        $media = ($this->nota + $this->nota2 + $this->nota3) / 3;
        return "Média: " . number_format($media, 2, ',', '.');
    }
    function exibirDetalhes(){
        return "
        <ul>
            <li>{$this->getResumo()}</li>
            <li>{$this->calcularNota()}</li>
            <li>{$this->calcularMedia()}</li>
        </ul>
        ";
    }
}
