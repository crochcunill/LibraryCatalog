<?php

$host = 'mysql';
$user = 'root';
$pass = 'rootpassword';
$dbname = 'casalcat_casalbiblioteca';

#$conn = new mysqli($host, $user, $pass,$dbname);
$link_ID = mysqli_connect($host, $user, $pass,$dbname);
if ($link_ID->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    #echo "Connected to MySQL successfully!";
}

/* To ensure that latin accents are displayed properly */
#printf("Initial character set: %s\n", $link_ID->character_set_name());

/* change character set to utf8mb4 */
$link_ID->set_charset("utf8mb4");

#printf("Current character set: %s\n", $link_ID->character_set_name());

$tamany_pagina=10;
?>
