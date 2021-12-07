<?php session_start(); ?>
<header>
    <div class="contenedor contenedor-header">
        <div class="titulo-website">
            <h1>Instituto de cursos</h1>
            <p class="subtitulo">¡Aprende eficientemente!</p>
        </div>

    
        <nav>

        <?php if(!isset($_SESSION['rol'])): ?>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="lista_cursos.php">Nuestros Cursos</a></li>
                <li><a href="formulario_registro.php">Registrarse</a></li>
                <li><a href="formulario_ingreso.php">Ingresar</a></li>
            </ul>
        <?php else: ?>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="lista_cursos.php">Nuestros Cursos</a></li>
                <li><a href="admin">Admin</a></li>
                <li><a href="includes/salir.php">Cerrar sesión</a></li>
            </ul>
        <?php endif; ?>
        </nav>
    </div> <!-- contenedor header-->
</header>