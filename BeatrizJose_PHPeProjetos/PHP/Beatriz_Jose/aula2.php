<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php
//Função usada para definir fuso horário padrão
date_default_timezone_set("America/Los_Angeles");
//Manipulando HTML e PHP
$data_hoje = date("d/m/y", time())
    ?>
<p align="center"> Olá, Beatriz. Hoje é dia <?php echo $data_hoje; ?>
</p>

<?php
echo "texto <br>";
echo "Olá Mundo<br>";
echo "Isso abrange
    várias linhas. As novas linhas serão saída também.";
echo "Isso abrange n\multiplas linhas. A nova linha será \n a saída também.<br>";
echo "Caracteres Escaping são feitos <br>\"Como esse\".";
?>
<br>
<br>

<?php
$comida_favorita="Italiana";
print $comida_favorita[2];
$comida_favorita = "Cozinha ".$comida_favorita;
echo "<br>";
print $comida_favorita;
?>

</body>
</html>