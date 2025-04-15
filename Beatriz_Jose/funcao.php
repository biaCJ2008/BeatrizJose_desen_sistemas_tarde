<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo $name="Beatriz Coimbra José";
    echo $length=strlen($name);
    echo $cmp = strcmp($name, "Brian Le");
    echo  $index = strpos($name , "e");
    echo $first = substr($name, 9,5);
    echo $name = strtoupper($name); 
    ?>

    <?php
    $cidade = "Joinville";
    $estado="SC";
    $idade = 325;
    $frase_capital="A cidade de $cidade não é a capital do $estado";
    $frase_idade= "A cidade de  $cidade tem mais de 170 anos!";
    echo "<h3>$frase_capital</h3>";
    echo "<h3>$frase_idade</h3>";
    ?>
 
</body>
</html>