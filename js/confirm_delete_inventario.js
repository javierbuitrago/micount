window.onload=function(){
	var btn_delete = document.getElementById('btn_delete');
	btn_delete.onclick = function(){
		var confirmar = confirm('Estas Seguro de Eliminar Este inventario.');
		if (confirmar) {
			location.href = 'elimina_inventario.php?cod_inventario=;
		}
		else{
			location.href = 'ver_inventario.php';
		}
	}
}

