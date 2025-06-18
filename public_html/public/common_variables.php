<?php
//$host = '10.169.0.50';
//$user = 'casalcat_biblio';
//$pass = 'Hola2006';

$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';

//$conn = new mysqli($host, $user, $pass);

$link_ID=mysqli_connect ($host, $user, $pass,'casalcat_casalbiblioteca');
mysqli_query($link_ID,"SET NAMES 'utf8'");
$tamany_pagina=10;
$paginacio=5;

?>
