
<?php

const NOME_CURSO = "Sistemas_de_Iformação";
const INSTITUICAO = "Multivix";
const ANO_CORRENTE = "2025";
const X0 = " ANO_CORRENTE - $ano_inicio_curso ";

$semestre_atual = "7";
$ano_inicio_curso ="2021";


$mensagen = "Estou no " . $semestre_atual . "° periodo do curso de " . NOME_CURSO . " a " . INSTITUICAO ;
echo "<p> $mensagen </p>";

$mensagen1 = "Você está no curso há " . X0 . " anos.";
echo "<p> $mensagen </p> . <br>";

$mensagem_boas_vindas = 'Bem-vindo ao NOME_CURSO, semestre $semestre_atual.';
echo "<h3>Tentativa com Aspas Simples:</h3>";
echo "<p>" . $mensagem_boas_vindas . "</p>";

$mensagem_corrigida_duplas = "Bem-vindo ao " . NOME_CURSO . ", semestre $semestre_atual.";
echo "<p>" . $mensagem_corrigida_duplas . "</p>";


$frutas = ['Banana', 'Uva', 'Melão'];

echo "A segunda fruta é: " . $frutas[1] . "<br>";


$produto = array(
    "nome" => "Elicoptero",
    "preco" => 25000.00,
    "estoque" => 12
);

$produto["cor1"] = "verde";
$produto["cor2"] = "azul";
$produto["cor3"] = "vermelho";
$produto["cor4"] = "preto";

echo "Produto: " . $produto["nome"] . "<br>";
echo "Preço: R$ " . number_format($produto["preco"], 2, ',', '.') . "<br>";
echo "Estoque: " . $produto["estoque"] . " unidades<br>";
echo "Cores disponiveis: " . $produto["cor1"] . ", " . $produto["cor2"] . ", " . $produto["cor3"] . ", " . $produto["cor4"] . "<br>";


echo "Teremos desponivel no estoque: " . count(value: $produto) . " cores.<br>";
echo "<pre>";
var_dump(value: $produto);
echo "</pre>";



$carrinho =[ 
    [
    "Nome"=> "luminaria",
    "preco"=> 65.00,
    "quantidade"=> 2,
],   
    [
        "Nome => "balde_tinta",


        ]


];


?>
