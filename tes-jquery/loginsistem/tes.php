<?php

$num = 20;
$result = 0;
$i = 0;


for ($i = 0; $i <= $num - 1; $i++) {
    echo "ok";
    $result = 5 * ($num % $i == 0);
}


var_dump($result);
