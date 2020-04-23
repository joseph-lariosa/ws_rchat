<?php


$token = mt_rand(10,50);
echo $token."<br>";

$tokenc = hex2bin($token);
echo $tokenc;