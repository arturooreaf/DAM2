<?php
// Proyecto1/index.php: 1,2,3,4,5,6 sin coma al final, de 3 formas
$tamano = 6;

for ($i = 1; $i <= $tamano; $i++)
{
    echo $i;
    if ($i < $tamano)
    {
        echo ',';
    }
}
echo '<br/>';

for ($i = 1; $i <= $tamano; $i++)
{
    if ($i > 1) echo ',';
    echo $i;
}
echo '<br/>';

$comma = "";
for ($i = 1; $i <= $tamano; $i++)
{
    echo $comma . $i;
    $comma = ",";
}
?>
