<?php 


$idadeAluno = 20;

if($idadeAluno <= 18){
echo "Aluno maior de idade" . "<br>";
} else { echo "Aluno menor de idade.<br>"
;}


$cores = ["vermelho", "verde", "azul", "amarelo", "roxo"];
echo "Novas cores:" . "<br>";
foreach ($cores as $cor) {
echo $cor . "<br>";

}

for ($numeroP = 2; $numeroP <= 10; $numeroP++) {
if ( $numeroP % 2 == 0)  {
echo $numeroP . "<br>";

  } 
    }
$diaSemana = "sabado";
switch ($diaSemana) {
    case "segunda":
        echo "É segunda-feira, inicio de semana.<br>";
        break;
    case "sexta":
        echo "Sextou! Bom fim de semana!<br>";
        break;
  default:
        echo "É um dia útil comum.<br>";
}

$notas_alunos =  ["matematica" => 7.5, "portugues" => 8.0,
    "historia" => 6.0, "ciencias" => 9.0];
foreach ($notas_alunos as $nomeDisciplina){

        switch ($nomeDisciplina) {
            case ($nomeDisciplina >= 7.0) :
                echo "aprovado";

            
        }  
    
}











    ?>
