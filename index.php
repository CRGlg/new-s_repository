<?php

const NOME_CURSO = "Sistemas_de_Iformação";
const INSTITUICAO = "Multivix";

$semestre_atual = "7";


$mensagen = "Estou no " . $semestre_atual . "° periodo do curso de " . NOME_CURSO . " a " . INSTITUICAO ;
echo "<p> $mensagen </p>";




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
