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
echo "<p> $mensagen </p>;
echo "<br>";

$frutas = ["Banana", "Uva", "Melão"];

echo "A segunda fruta é: " . $frutas[1] . "<br>";


$produto = array(
    "nome" => "Elicoptero",
    "preco" => 25000.00,
    "estoque" => 12
);

echo "Produto: " . $produto["nome"] . "<br>";
echo "Preço: R$ " . number_format($produto["preco"], 2, ',', '.') . "<br>";
echo "Estoque: " . $produto["estoque"] . " unidades<br>";



?>
