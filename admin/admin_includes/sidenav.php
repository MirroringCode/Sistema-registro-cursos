
<nav class="navegacion">
		<span class="abrir-menu">
			<a href="#" onclick="abrirMenu()">
	           <i class="fas fa-bars"></i>
			</a>
		</span>
		<ul class="barra-nav">
        	<li><a href="../index.php" class="links"><i class="fas fa-home"></i> Pagina principal</a></li>
		</ul>
</nav>       


<!-- Menú desplegable para navegar la página -->
 <div id="menu-lateral" class="menu-sidebar">
 
<div class="btn-cerrar">     
<a href="#" class="cerrar" onclick="cerrarMenu()">&times;</a>
</div>

<!-- Si el usuario es admin va a mostrar los siguientes links -->
<?php if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'): ?>
<a href="../index.php"><i class="fas fa-home"></i> Pagina principal</a>
<a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
<a href="cursos.php"><i class="fas fa-list"></i> Lista cursos</a>
<a href="añadir_curso.php"><i class="far fa-plus-square"></i> Agregar cursos</a>
<a href="materiales.php"><i class="fas fa-book"></i> Materiales</a>
<a href="profesores.php"><i class="fas fa-chalkboard-teacher"></i> Profesores</a>
<a href="usuarios.php"><i class="fas fa-users"></i> Lista usuarios</a>
<a href="inscribirse.php"><i class="fas fa-graduation-cap"></i> inscribirse en cursos</a>
<a href="perfil.php"><i class="fas fa-user"></i> Perfil</a>
<a href="../includes/salir.php"><i class="fas fa-sign-out-alt"></i> Salir</a>

<!-- Si el usuario es un estudiante solo van a aparecer estos links -->
<?php elseif(isset($_SESSION['rol']) && $_SESSION['rol'] === 'estudiante'): ?>
<a href="../index.php"><i class="fas fa-home"></i> Pagina principal</a>
<a href="index.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
<a href="inscribirse.php"><i class="fas fa-graduation-cap"></i> inscribirse en cursos</a>
<a href="perfil.php"><i class="fas fa-user"></i> Perfil</a>
<a href="../includes/salir.php"><i class="fas fa-sign-out-alt"></i> Salir</a>

<?php else: ?>
<a href="../index.php"><i class="fas fa-home"></i> Pagina principal</a>

<?php endif; ?>
</div>

