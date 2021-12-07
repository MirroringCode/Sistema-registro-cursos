<?php

$host_bdd = 'localhost';
$usuario_bdd = 'root';
$nombre_bdd = 'prep_sys';


$conexion = mysqli_connect($host_bdd, $usuario_bdd, '', $nombre_bdd);



mysqli_set_charset($conexion, "utf8");



