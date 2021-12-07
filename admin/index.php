<?php include_once("admin_includes/adm_encabezado.php"); ?>

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
		
		<div class="contenedor-dashboard">
		
		<?php if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>

		<div class="item-dashboard">
			<i class="fas fa-home"></i>
			<a href="../index.php">Página principal</a>
		</div>
		
		<div class="item-dashboard">
			<i class="fas fa-list"></i>
			<a href="cursos.php">Lista de cursos</a>
		</div>
		
		<div class="item-dashboard">
			<i class="far fa-plus-square"></i>
			<a href="añadir_curso.php">Agregar cursos</a>
		</div>
		
		<div class="item-dashboard">
			<i class="fas fa-book"></i>
			<a href="materiales.php">Lista de materiales</a>
		</div>
		
		<div class="item-dashboard">
			<i class="fas fa-chalkboard-teacher"></i>
			<a href="profesores.php">Profesores</a>
		</div>
		
		<div class="item-dashboard">
			<i class="fas fa-users"></i>
			<a href="usuarios.php">Lista de usuarios</a>
		</div>
		
		<div class="item-dashboard">
			<i class="fas fa-user"></i>
			<a href="perfil.php">Perfil</a>
		</div>

		<div class="item-dashboard">
			<i class="fas fa-sign-out-alt"></i>
			<a href="../includes/salir.php">Salir</a>
		</div>

		<?php elseif(isset($_SESSION['rol']) && $_SESSION['rol'] === 'estudiante'): ?>
		
		<div class="item-dashboard">
			<i class="fas fa-home"></i>
			<a href="../index.php">Página principal</a>
		</div>
		
		<div class="item-dashboard">
			<i class="fas fa-user"></i>
			<a href="perfil.php">Perfil</a>
		</div>

		<div class="item-dashboard">
		<i class="fas fa-graduation-cap"></i>
			<a href="inscribirse.php">Inscribirse en cursos</a>
		</div>


		<div class="item-dashboard">
			<i class="fas fa-sign-out-alt"></i>
			<a href="../includes/salir.php">Salir</a>
		</div>
		<?php endif; ?>
		

		
		
		</div>
    </main>
</div>

</div>


<?php include_once "admin_includes/adm_pie.php"; ?>