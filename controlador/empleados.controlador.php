<?php

class ctrEmpleados
{

	static public function ctrIngresoEmpleado()
	{

		if (isset($_POST['log_user'])) {
			$cifrarPass = crypt($_POST['log_pass'], '$5$rounds=5000$usesomesillystringforsalt$');

			$tabla = "usuarios";
			$item = "usuario";
			$valor = $_POST['log_user'];

			$respuesta = mdlEmpleados::mdlSesionEmpleados($tabla, $item, $valor);

			if ($respuesta['usuario'] == $_POST['log_user'] && $respuesta['password'] == $cifrarPass) {

				$_SESSION['validarSesion'] = "ok";
				$_SESSION['idBackend'] = $respuesta['id'];

				echo '<script> window.location = "home"; </script>';
			} else {
				echo '<div class="alert alert-danger mt-3 small">Error: Usuasio y/o contraseña incorrecta</div>';
			}
		}
	}

	static public function ctrEliminarEmpleados($item, $valor)
	{
		$tabla = "empleado";
		$respuesta = mdlEmpleados::mdlEliminarEmpleado($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarEmpleados1($item, $valor)
	{
		$tabla = "empleado";

		$respuesta = mdlEmpleados::mdlMostrarEmpleado1($tabla, $item, $valor);

		return $respuesta;
	}

	static public function ctrMostrarEmpleados2()
	{
		$respuesta = mdlEmpleados::mdlMostrarEmpleado2();

		return $respuesta;
	}

	static public function ctrMostrarEmpleados()
	{
		$tabla = "empleado";

		$repuesta = mdlEmpleados::mdlMostrarEmpleados($tabla);

		return $repuesta;
	}

	static public function ctrEditarEmpleados()
	{

		if (isset($_POST['id_empleado_edE'])) {

			$datos = array(
				"idE" => $_POST["id_empleado_edE"],
				"nom_empleadoE" => $_POST["ed_nom_empleadoE"],
				"ape_empleadoE" => $_POST["ed_ape_empleadoE"],
				"ci_EmpleadoE" => $_POST["ed_ci_EmpleadoE"],
				"carg_empleadoE" => $_POST["ed_carg_empleadoE"],
				"telefono_EmpleadoE" => $_POST["ed_telefono_EmpleadoE"],
				"direccion_EmpleadoE" => $_POST["ed_direccion_EmpleadoE"],
				"fecha_EmpleadoE" => $_POST["ed_fecha_EmpleadoE"],
				"ingreso_EmpleadoE" => $_POST["ed_servicio_EmpleadoE"],
				"ed_correo_EmpleadoE" => $_POST["ed_correo_EmpleadoE"]
			);

			$tabla = "empleado";

			$respuesta = mdlEmpleados::mdlEditarEmpleado($tabla, $datos);

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
									window.location = "empleados";
									}
								});
						</script>';
			} else {
				echo "<div class='alert alert-danger mt-3 small'>Edición fallida</div>";
			}
		}
	}

	static public function ctrGuardarEmpleado()
	{

		if (isset($_POST['nom_empleado'])) {

			$datos = array(
				'nom_empleado' => $_POST['nom_empleado'],
				'ape_empleado' => $_POST['ape_empleado'],
				'carg_empleado' => $_POST['carg_empleado'],
				'ci_empleado' => $_POST['ci_Empleado'],
				'fecha_Empleado' => $_POST['fecha_Empleado'],
				'telefono_Empleado' => $_POST['telefono_Empleado'],
				'direccion_Empleado' => $_POST['direccion_Empleado'],
				'servicio' => $_POST['año_Empleado'],
				'correo_Empleado' => $_POST['correo_Empleado']
			);
			echo "</pre>";
			print_r($datos);
			echo "</pre>";

			$tabla = "empleado";

			$respuesta = mdlEmpleados::mdlguardarEmpleado($tabla, $datos);

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
