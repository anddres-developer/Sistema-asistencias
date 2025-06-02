<?php

class ctrUsuarios
{

	static public function ctrIngresoUsusrio()
	{

		if (isset($_POST['log_user'])) {
			$cifrarPass = crypt($_POST['log_pass'], '$5$rounds=5000$usesomesillystringforsalt$');

			$tabla = "usuarios";
			$item = "usuario";
			$valor = $_POST['log_user'];

			$respuesta = mdlUsuarios::mdlSesionUsuarios($tabla, $item, $valor);

			if ($respuesta['usuario'] == $_POST['log_user'] && $respuesta['password'] == $cifrarPass) {

				$_SESSION['validarSesion'] = "ok";
				$_SESSION['idBackend'] = $respuesta['id'];
				$_SESSION['rol'] = $respuesta['rol'];

				echo '<script> window.location = "home"; </script>';
			} else {
				echo '<div class="alert alert-danger mt-3 small">Error: Usuasio y/o contraseña incorrecta</div>';
			}
		}
	}

	static public function ctrEliminarUsuarios($id, $rutafoto)
	{

		unlink("../" . $rutafoto);

		$tabla = "usuarios";
		$respuesta = mdlUsuarios::mdlEliminarUsuarios($tabla, $id);

		return $respuesta;
	}

	static public function ctrMostrarUsuarios1($item, $valor)
	{
		$tabla = "usuarios";

		$respuesta = mdlUsuarios::mdlMostrarUsuarios1($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarUsuarios()
	{
		$tabla = "usuarios";

		$repuesta = mdlUsuarios::mdlMostrarUsuarios($tabla);

		return $repuesta;
	}

	static public function ctrEditaruarios()
	{

		if (isset($_POST['ed_idPerfil'])) {
			if (isset($_FILES['ed_subirImgUsuario']['tmp_name']) && !empty($_FILES['ed_subirImgUsuario']['tmp_name'])) {
				list($ancho, $alto) = getimagesize($_FILES['ed_subirImgUsuario']['tmp_name']);
				$nuevoAncho = 480;
				$nuevoAlto = 382;

				/* Directorio donde se guardará la foto de los usuarios*/
				$directorio = "vistas/imagenes/usuarios";

				/* Elimina la foto vieja del servidor */
				if (isset($_POST['fotoActualE'])) {

					unlink($_POST['fotoActualE']);
				}

				if ($_FILES['ed_subirImgUsuario']['type'] == "image/jpeg") {

					$aleatorio = mt_rand(100, 999);

					$ruta = $directorio . "/" . $aleatorio . ".jpg";

					$origen = imagecreatefromjpeg($_FILES['ed_subirImgUsuario']['tmp_name']);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
				} elseif ($_FILES['ed_subirImgUsuario']['type'] == "image/png") {

					$aleatorio = mt_rand(100, 999);

					$ruta = $directorio . "/" . $aleatorio . ".png";

					$origen = imagecreatefrompng($_FILES['ed_subirImgUsuario']['tmp_name']);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);

					imagesavealpha($destino, TRUE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);
				} else {
					echo '<script>
						swal.fire({
								icon:"error",
								title:"¡CORREGIR¡",
								text: "¿no se permiten formatos diferentes a JPG y/o PNG",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"
							}).then(function(result){
								if(result.value){
									history.back();
								}
								});
					</script>';
					return;
				}
			}

			/* Comprueba si hay cambio de foto */

			if ($ruta != "") {
				$r = $ruta;
			} else {
				$r = $_POST['fotoActualE'];
			}

			/*Compueba si hay cambio de contraseña */
			if ($_POST['ed_pass_user'] != "") {
				$password = crypt($_POST['ed_pass_user'], '$5$rounds=5000$usesomesillystringforsalt$');
			} else {
				$password = $_POST['pass_useractual'];
			}

			$datos = array(
				"idE" => $_POST["ed_idPerfil"],
				"nom_usuarioE" => $_POST["ed_nom_usuario"],
				"ape_usuarioE" => $_POST["ed_ape_usuario"],
				"nom_userE" => $_POST["ed_nom_user"],
				"email_userE" => $_POST["ed_mail_user"],
				"passE" => $password,
				"rol_userE" => $_POST["ed_rol_user"],
				"img" => $r
			);

			$tabla = "usuarios";

			$respuesta = mdlUsuarios::mdlEditarUsuarios($tabla, $datos);

			if ($respuesta = "ok") {
				echo '<script>
							swal.fire({
								icon:"success",
								title:"¡CORRECTO¡",
								text: "el ususario ha sido editado correctamente",
								showConfirmButton: true,
								confirmButtonText: "Cerrar"

							}).then(function(result){

								if(result.value){
									//history.back();
									window.location = "usuarios";
									}
								});
						</script>';
			} else {
				echo "<div class='alert alert-danger mt-3 small'>Edición fallida</div>";
			}
		}
	}

	static public function ctrGuardarusuarios()
	{

		if (isset($_POST['nom_usuario'])) {

			if (isset($_FILES['subirImgUsuario']['tmp_name']) && !empty($_FILES['subirImgUsuario']['tmp_name'])) {

				list($ancho, $alto) = getimagesize($_FILES['subirImgUsuario']['tmp_name']);
				$nuevoAncho = 480;
				$nuevoAlto = 382;

				/* Directorio donde se guardará la foto de los usuarios*/
				$directorio = "vistas/imagenes/usuarios";

				/* De acuerdo al tipo de imagen aplica las funciones por defecto en PHP*/
				if ($_FILES['subirImgUsuario']['type'] == "image/jpeg") {

					$aleatorio = mt_rand(100, 999);

					$ruta = $directorio . "/" . $aleatorio . ".jpg";

					$origen = imagecreatefromjpeg($_FILES['subirImgUsuario']['tmp_name']);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
				} elseif ($_FILES['subirImgUsuario']['type'] == "image/png") {

					$aleatorio = nt_rande(100, 999);

					$ruta = $directorio . "/" . $aleatorio . ".png";

					$origen = imagecreatefromjpeg($_FILES['subirImgUsuario']['tmp_name']);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagealphablending($destino, FALSE);

					imagesavealpha($destino, FALSE);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
				} else {
					echo '<script>
							swal.fire({
									icon:"error",
									title:"¡CORREGIR¡",
									text: "¿no se permiten formatos diferentes a JPG y/o PNG",
									showConfirmButton: true,
									confirmButtonText: "Cerrar"
								}).then(function(result){
									if(result.value){
										history.back();
									}
									});
						</script>';
					return;
				}

				$cifrarPassword = crypt($_POST['pass_user'], '$5$rounds=5000$usesomesillystringforsalt$');

				$datos = array(
					'nom_usuario' => $_POST['nom_usuario'],
					'ape_usuario' => $_POST['ape_usuario'],
					'nom_user' => $_POST['nom_user'],
					'mail_user' => $_POST['mail_user'],
					'pass_user' => $cifrarPassword,
					'rol_user' => $_POST['rol_user'],
					'foto' => $ruta
				);
				echo "</pre>";
				print_r($datos);
				echo "</pre>";

				$tabla = "usuarios";

				$respuesta = mdlUsuarios::mdlguardarUsuarios($tabla, $datos);

				if ($respuesta = 'ok') {
					echo '<script> 
							swal.fire({
								icon: "success",
								title: "¡CORRECTO¡",
								text: "El usuario ha sido creado correctamente",
								showConfirmButton: true,
								confirmButtonText: "cerrar"
								}).then(function(result){
									if(result.value){
										history.back();
									}
									});
						</script>';
				} else {
					echo '<div class="alert alert-danger mt-3 small">Registro fallido</div>';
				}
			}
		}
	}
}
