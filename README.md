# ATIVIDADE 7 PHP

> "Projeto foi desenvolvido em WEB durante as aulas do curso técnico, abordando conceitos de PHP."

## 📌 Sobre o Projeto

Este repositório contém um projeto em WEB, focando em conceitos essenciais da linguagem, como:

- Aprendizado do PHP

O projeto visa consolidar o aprendizado e podem ser utilizados como portfólio profissional.

---
## 🛠️ Tecnologias Utilizadas

- vizual code
- Git/GitHub para versionamento

---

## 🚀 Como Executar

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/Ghost-souza006/Atividade7
   ```
2. **Abra o projeto em sua IDE favorita**.
3. **Compile e execute** os arquivos `.web` conforme necessário.
   ```bash
   Atividade7/
   ```
---
## 📂 Estrutura do Repositório

```bash

📁 projeto-poo-php/
│
├── style.css                   
├── indexprinci.php             
│
├── 📁 BÁSICO (3 exercícios)
│   ├── exer2.php                  
│   ├── exer3.php                  
│   └── funcionario.php           
│
├── 📁 INTERMEDIÁRIO (3 exercícios)
│   ├── ex4_carro.php             
│   ├── ex5_produto.php           
│   └── ex6_conversor.php         
│
├── 📁 AVANÇADO (5 exercícios)
│   ├── ex7_viagem.php            
│   ├── ex8_calculadora.php       
│   ├── ex9_pessoa.php             
│   ├── ex10_reserva.php          
│   └── ex11_geometrica.php        
│
└── 📄 README.md        
```
---
## 📖 Exemplos de Código
```bash
<?php
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $valor_real = floatval($_POST["valor_real"]);
     $cotacao_usd = 5.21; 
        $valor_usd = $valor_real / $cotacao_usd;
        
       $valor_real_formatado = number_format($valor_real, 2, ",", ".");
      $valor_usd_formatado = number_format($valor_usd, 2, ",", ".");
        
    echo "<p>R$ $valor_real_formatado equivalem a US$ $valor_usd_formatado</p>";
 }
?>
```
---
## 🏆 Autor(es)

👤 **Leonardo Schmitt de Souza**  
📧 Email: leo.schmitt2708@gmail.com  
🔗 [GitHub](https://Ghost-souza006)

---

## 🎯 Objetivo do Repositório

Este repositório serve como um portfólio para demonstrar habilidades em PHP, ajudando na busca de oportunidades de emprego na área de desenvolvimento em um futuro próximo.
---
