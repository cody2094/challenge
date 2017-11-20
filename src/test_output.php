<?php

include('Challenge.php');
$challenge = new Challenge();
$challenge->build_possibilities();

$challenge->change_currency("Coin,1.5,Arrowhead,3,Button,150");
$challenge->build_possibilities();
//

?>
