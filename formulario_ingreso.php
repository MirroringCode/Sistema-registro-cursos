<?php session_start(); ?>
<?php 
//si hay una sesión abierta devuelve a la página principal
if (isset($_SESSION['rol'])) {
    header("Location: index.php");
} else {

?>



<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Ingreso</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='estilos/estilo_formulario.css'>
    <script src='scripts/validar_ingreso.js' defer></script>
</head>
<body>
    <div class="Contenedor-principal">
        <div class="contenedor-titulo">
            <h1 id="titulo">Ingresa tus datos para acceder</h1>
        </div>
        <form id="formulario_ingreso" action="includes/login.php" method="POST" name="formulario_ingreso">
        <div class="direccion_texto">
            <label for="usuario" id="etiqueta-usuario">Usuario: </label>
            <input type="text" id="usuario" name="usuario" placeholder="Tu nombre de usuario">
            <label for="contraseña" id="etiqueta-contraseña">Contraseña: </label>
            <input type="password" id="contraseña" name="contraseña" placeholder="Ingrese su contraseña" >
            <div class="direccion-botones">
            <button type="submit" class="boton-enviar" id="enviar" name="login">Enviar</button>
            <button type="reset" class="boton-reset">Restablecer</button>
             </div>
        </div>
        <a href="formulario_registro.php" class="link-registro">¿No tienes una cuenta todavía?</a>
        </form>
        <div class="container-home-ingreso">
        <a href="index.php" class="icono-home"><img src="imagenes/home_circle_icon_137496.png" alt="home"></a>
        </div>
</body>
</html>

<?php } ?>