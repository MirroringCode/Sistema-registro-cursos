<script>
	// Abre el menu lateral 
	function abrirMenu() {
	document.getElementById('menu-lateral').style.width = '250px';
	document.getElementById('principal').style.marginLeft = '250px';
}

function cerrarMenu() {
	// Cierra el menu lateral
	document.getElementById('menu-lateral').style.width = '0';
	document.getElementById('principal').style.marginLeft = '0';
}
</script>
</body>
</html>