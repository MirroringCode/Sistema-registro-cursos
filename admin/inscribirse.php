<?php include_once("admin_includes/adm_encabezado.php"); ?>

    <!-- <header>
    </header> -->
<div class="contenedor">

<?php include_once("admin_includes/sidenav.php");  ?>

 <div class="contenedor-principal" id="principal">
    <main>
        <div class="contenedor-divisor">    
            <div class="direccion-titulo">
            <h1>Inscribirse en cursos</h1> 
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

        case "cursos_informatica":
        include_once("admin_includes/editar_curso.php");
        break;

       /*  case "listado":
        include_once("admin_includes/usuarios_registrados.php");
        break;
        
        case "materiales_curso":
        include_once("admin_includes/ver_materiales_curso.php");
        break;

        case "asignar":
        include_once("admin_includes/asignar_material.php");
        break; */

        default:
        include_once("admin_includes/ver_cursos_inscribirse.php");
        break;

    }

    ?>



    </main>
</div>

</div>

<?php include_once "admin_includes/adm_pie.php"; ?>

