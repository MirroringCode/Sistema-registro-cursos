<aside class="barra-lateral">

		<!-- Se crea un formulario que actuará como barra de busqueda para mostrar los cursos
		dependiendo de lo que ingrese el usuario -->

		<div class="buscador">
			<form action="busqueda.php" method="POST">
				<div class="campo">
				<label for="campo_busqueda">Buscar cursos por area</label>
				<div>
				<input type="text" name="campo_busqueda" required maxlength="11">
				<span>
				<button type="submit" name="buscar" class="boton-buscar">
				<span class="boton-buscar">
				<i class="fas fa-search"></i>
				</span>
				</button>
				</span>
				</div>
				</div>
			</form>
		</div>



		<?php 
		
		/*Creamos una secuencia de comandos SQL para seleccionar todas las areas de cursos que están almacenadas 
		en la tabla "areas" */
		$query = "SELECT area FROM areas";
		$seleccionar_areas_barra = mysqli_query($conexion, $query);

		//Si el query falla terminamos la conexión y mostamos un mensaje de error
		if(!$seleccionar_areas_barra) {
			die('Query fallido' . mysqli_error($conexion));
		}

		?>

		<div class="lista-categorias">			
			<ul>

			<?php 
			
			//Utilizamos un bucle while y una función para que los datos seleccionados salgan como un arreglo asociativo
			//Y luego le hacemos echo en la barra lateral donde salen los links

			while($fila = mysqli_fetch_assoc($seleccionar_areas_barra)) {
				$area_curso = ucfirst($fila['area']);

				echo "<li><a href='areas.php?area_curso={$area_curso}'>{$area_curso}</a></li>";
			}
			
			// En la parte donde hicimos echo para los links asignamos a la etiqueta <a> para que mande a una página
			//diferente (areas.php) donde se mostrarán todos los cursos que sean del area clickeada  
			//(informatica, diseño, etc)
			
			?>
			</ul>

		</div>
	</aside>