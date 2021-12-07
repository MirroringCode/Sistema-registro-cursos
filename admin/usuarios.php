
<?php include_once("admin_includes/adm_encabezado.php"); ?>

<?php 

if($_SESSION['rol'] === 'admin') {

?>
    <!-- <header>
    </header> -->
<div class="contenedor">

<?php include_once("admin_includes/sidenav.php");  ?>

 <div class="contenedor-principal" id="principal">
    <main>
        <div class="contenedor-divisor">    
            <div class="direccion-titulo">
            <h1>Bienvenido al dashboard</h1> 
            <p><?php echo $_SESSION['usuario']; ?></p>
            </div>
        </div>


    <?php 
    //declaracion if que determina si el parametro "direccion" está presente en el URL de la página luego declara una variable y almacena ese valor
    
    if(isset($_GET['direccion'])) {
        $direccion = $_GET['direccion'];
    } else {
        $direccion = '';
    }

    //sentencia switch que dependiendo de el valor actual de "direccion" va a mostrar una página diferente
    switch($direccion) {

        case "69":
        echo "nice";
        break;

        case "66":
        echo "semi-nice";
        break;

        default:
        include_once("admin_includes/ver_usuarios.php");
        break;

    }

    ?>

<?php include_once "admin_includes/adm_pie.php"; ?>
<?php 
} else {

header("Location: index.php");

}	
	
?>