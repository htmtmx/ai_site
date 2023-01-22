<?php

///////////////////////// GENERALES /////////////////////////  

function conexion($bd_config){

	try { 

		$conexion = new PDO('mysql:host=localhost;dbname='.$bd_config['basedatos'], $bd_config['usuario'], $bd_config['pass']);
		return $conexion;
		
	} catch (PDOException $e) {
		
		return false;

	}

}


function limpiarDatos($datos){ //quitar etiquetas HTML a los datos, evitar que el usuario quiera insertar código 

	$datos = trim($datos);
	$datos = stripcslashes($datos);
	$datos = htmlspecialchars($datos);
	return $datos;
}


function id_recibido($id){

      return (int)limpiarDatos($id);
}


///////////////////////// SALTO DE LINEA /////////////////////////

function saltoLinea($str) { 
  return str_replace(array("\r\n", "\r", "\n"), "<br />", $str); 
}  


function saltoLineaRev($str) { //Sólo para que se quite el <br> en los edits
  return str_replace(array("<br />"), "\n", $str); 
} 




///////////////////////// QUITAR $ y , /////////////////////////

function limpiarPrecio($str) { 
  return str_replace(array("$", ",", "MXN", "pesos", "PESOS", "Pesos", " "), "", $str); 
}  


///////////////////////// Cambiar medidas youtube /////////////////////////

function limpiar560($str) { //962
  return str_replace(array("962"), "390", $str); 
} 

function limpiar315($str) { //541
  return str_replace(array("541"), "235", $str);
} 

////////////////////////  PÁGINA PRINCIAL /////////////////////////


function lasKeywords($conexion){ 

      $statement = $conexion->prepare("SELECT id_pag_principal, keywords_pag, descripcion_pag FROM pagina_principal;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}



function elSlider($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM slider WHERE id_slider = 1;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function seccBanner($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM pagina_principal WHERE id_pag_principal = 1;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function losAnuncios($conexion){ 

      $statement = $conexion->prepare("SELECT id_pag_principal, anuncio_top, anuncio_enmedio, anuncio_fin, anuncio_texto_url, anuncio_url, anuncio_foto FROM pagina_principal WHERE id_pag_principal = 1;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function elPopUp($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM pop_up WHERE id_pop_up = 1;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function casosExito($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM casos_exito WHERE id_casos_exito = 1;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}

function elWhatsapp($conexion){ 

      $statement = $conexion->prepare("SELECT whatsapp_pag FROM pagina_principal WHERE id_pag_principal = 1;");
      $statement->execute(array());
      $resultado = $statement->fetchColumn();
      return $resultado;

}


function elCorreo($conexion){ 

      $statement = $conexion->prepare("SELECT correo_cotiz FROM pagina_principal WHERE id_pag_principal = 1;");
      $statement->execute(array());
      $resultado = $statement->fetchColumn();
      return $resultado;

}



///////////////////////// EQUIPOS /////////////////////////


function lasMarcasActivas($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM marca WHERE activa_marca = 'true' ORDER BY nombre_marca ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}

function lasMarcas($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM marca ORDER BY nombre_marca ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}

function infoMarca($conexion, $id_marca){ 

      $statement = $conexion->prepare("SELECT * FROM marca WHERE id_marca = :id_marca;");
      $statement->execute(array(':id_marca' => $id_marca));
      $resultado = $statement->fetchAll();
      return $resultado;

}


function tipoProducto($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM tipo_producto ORDER BY nombre_tipo_producto ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}

function tipoProductoActivo($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM tipo_producto WHERE activo_tipop = 'true' ORDER BY nombre_tipo_producto ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}

function infoTipoProducto($conexion, $id_tipo_producto){ 

      $statement = $conexion->prepare("SELECT * FROM tipo_producto WHERE id_tipo_producto = :id_tipo_producto;");
      $statement->execute(array(':id_tipo_producto' => $id_tipo_producto));
      $resultado = $statement->fetchAll();
      return $resultado;

}


function clasifEquipo($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM clasificacion_equipo cleq INNER JOIN tipo_producto tip ON cleq.TiProd_clas_eq = tip.id_tipo_producto ORDER BY nombre_clas_eq ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}

function infoClasifEquipo($conexion, $id_clas_eq){ 

      $statement = $conexion->prepare("SELECT * FROM clasificacion_equipo WHERE id_clas_eq = :id_clas_eq;");
      $statement->execute(array(':id_clas_eq' => $id_clas_eq));
      $resultado = $statement->fetchAll();
      return $resultado;

}

function clasifEquipoDelTipProd($conexion, $id_tipo_producto){ 

      $statement = $conexion->prepare("SELECT * FROM clasificacion_equipo cleq INNER JOIN tipo_producto tip ON cleq.TiProd_clas_eq = tip.id_tipo_producto AND cleq.TiProd_clas_eq = :id_tipo_producto ORDER BY nombre_clas_eq ASC;");
      $statement->execute(array(':id_tipo_producto' => $id_tipo_producto));
      $resultado = $statement->fetchAll();
      return $resultado;

}


function verEquipos($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM equipo equi INNER JOIN tipo_producto tip ON equi.Id_TipoProducto_Eq = tip.id_tipo_producto ORDER BY equi.modelo_equipo ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function verEquiposDestacados($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM equipo WHERE etiqueta_eq != '' ORDER BY modelo_equipo ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function infoEquipo($conexion, $id_equipo){ 

      $statement = $conexion->prepare("SELECT * FROM equipo equi INNER JOIN tipo_producto tip INNER JOIN marca mar INNER JOIN clasificacion_equipo cleq ON equi.Id_TipoProducto_Eq = tip.id_tipo_producto AND equi.marca_equipo = mar.id_marca AND equi.clasificacion_equipo = cleq.id_clas_eq AND equi.id_equipo = :id_equipo ORDER BY equi.modelo_equipo ASC;");
      $statement->execute(array(':id_equipo' => $id_equipo));
      $resultado = $statement->fetchAll();
      return $resultado;

}




///////////////////////// BLOG /////////////////////////


function verEntradas($conexion){ 

      $statement = $conexion->prepare("SELECT * FROM blog WHERE activado_nota = 'Publicado' ORDER BY fecha_publicacion ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function infoEntrada($conexion, $id_blog){ 

      $statement = $conexion->prepare("SELECT * FROM blog WHERE id_blog = :id_blog ORDER BY fecha_publicacion ASC;");
      $statement->execute(array(':id_blog' => $id_blog));
      $resultado = $statement->fetchAll();
      return $resultado;

}




///////////////////////// COTIZACIONES /////////////////////////



function introCotizaciones($conexion){

      $statement = $conexion->prepare("SELECT * FROM cotizacion ORDER BY fecha_cotizacion ASC;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function infoCotiz($conexion, $id_cotizacion){

      $statement = $conexion->prepare("SELECT * FROM cotizacion WHERE id_cotizacion = :id_cotizacion;");
      $statement->execute(array(':id_cotizacion' => $id_cotizacion));
      $resultado = $statement->fetchAll();
      return $resultado;

}


function equiposCotizados($conexion, $id_cotizacion){

      $statement = $conexion->prepare("SELECT * FROM contenido_cot conten INNER JOIN cotizacion coti INNER JOIN equipo equi ON conten.id_dela_cotizacion = coti.id_cotizacion AND conten.id_prod_cotizado = equi.id_equipo AND (coti.id_cotizacion = :id_cotizacion);");
      $statement->execute(array(':id_cotizacion' => $id_cotizacion));
      $resultado = $statement->fetchAll();
      return $resultado;

}


function tipoCambioUSD($conexion){

      $statement = $conexion->prepare("SELECT cambio_a_pesos FROM moneda_cambio WHERE nombre_moneda = 'USD' LIMIT 1;");
      $statement->execute(array());
      $resultado = $statement->fetchColumn();
      return $resultado;

}

function tipoCambioEUR($conexion){

      $statement = $conexion->prepare("SELECT cambio_a_pesos FROM moneda_cambio WHERE nombre_moneda = 'EUR' LIMIT 1;");
      $statement->execute(array());
      $resultado = $statement->fetchColumn();
      return $resultado;

}

///////////////////////// USUARIOS /////////////////////////


function listaUsuarios($conexion){

      $statement = $conexion->prepare("SELECT * FROM usuarios_admin");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}


function editarUsuario($conexion, $id){

      $statement = $conexion->prepare("SELECT * FROM usuarios_admin WHERE id = $id;");
      $statement->execute(array());
      $resultado = $statement->fetchAll();
      return $resultado;

}




///////////////////////// COMPROBAR SESIÓN /////////////////////////

function comprobarSession(){

	if (!isset($_SESSION['usuario'])) {
	
	header('Location: login.php');
	}
	
}
?>