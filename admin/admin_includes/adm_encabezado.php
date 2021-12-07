<?php include_once("../includes/bdd.php"); ?>
<?php include_once("funciones.php"); ?>
<?php ob_start(); ?>
<?php session_start(); ?>


<?php 
// Si no está activa la sesión devuelve a la página principal
if(!isset($_SESSION['rol'])) {
	header("Location: ../index.php");
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <link rel="stylesheet" type="text/css" href="../estilos/fontawesome-free-5.15.4-web/css/all.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../estilos/fontawesome-free-5.15.4-web/css/all.min.css"> -->
    <link rel="stylesheet" type="text/css" href="adm_estilos/estilo-admin.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e0edc37a5c.js" crossorigin="anonymous"></script>
    <title>Admin</title>
</head>
<body>