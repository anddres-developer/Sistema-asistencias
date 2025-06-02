<?php

require_once "coneccion.php";

class mdlEmpleados
{

	static public function mdlSesionEmpleados($tabla, $item, $valor)
	{

		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item =:$item");

		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
		$stmt->close();
		$stmt = null;
	}

	static public function mdlEliminarEmpleado($tabla, $item, $valor)
	{

		$stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :id");

		$stmt->bindParam(":id", $valor, PDO::PARAM_INT);



		if ($stmt->execute()) {
			return "ok";
		} else {
			echo "error";
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlEditarEmpleado($tabla, $datos)
	{

		$stmt = conexion::conectar()->prepare("UPDATE $tabla SET nombre = :NOM_E, apellido = :APE_E, ci = :CI_E, cargo = :CARGO_E, num_tlf = :TELF_E, direccion = :DIREC_E, fecha_ingreso = :FECHA_E, fecha_servicio = :INGRESO_E, correo = :EMAIL_E WHERE id_empleado = :IDE");

		$stmt->bindParam(":IDE", $datos['idE'], PDO::PARAM_INT);
		$stmt->bindParam(":NOM_E", $datos['nom_empleadoE'], PDO::PARAM_STR);
		$stmt->bindParam(":APE_E", $datos['ape_empleadoE'], PDO::PARAM_STR);
		$stmt->bindParam(":CI_E", $datos['ci_EmpleadoE'], PDO::PARAM_STR);
		$stmt->bindParam(":CARGO_E", $datos['carg_empleadoE'], PDO::PARAM_INT);
		$stmt->bindParam(":TELF_E", $datos['telefono_EmpleadoE'], PDO::PARAM_STR);
		$stmt->bindParam(":DIREC_E", $datos['direccion_EmpleadoE'], PDO::PARAM_STR);
		$stmt->bindParam(":FECHA_E", $datos['fecha_EmpleadoE'], PDO::PARAM_STR);
		$stmt->bindParam(":INGRESO_E", $datos['ingreso_EmpleadoE'], PDO::PARAM_STR);
		$stmt->bindParam(":EMAIL_E", $datos['ed_correo_EmpleadoE'], PDO::PARAM_STR);


		if ($stmt->execute()) {
			return "ok";
		} else {
			echo "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarEmpleado1($tabla, $item, $valor)
	{

		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = $valor");

		//$stmt->bindParam(":" . $item, $valor['idEmpleadoE'], PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
	}

	static public function mdlMostrarEmpleado2()
	{

		$stmt = conexion::conectar()->prepare("SELECT *,empleado.cargo, cargo.id_cargo, cargo.nombre as 'nom_cargo' FROM asistencia  INNER JOIN empleado on asistencia.id_empleado = empleado.id_empleado INNER JOIN cargo ON empleado.cargo = cargo.id_cargo ORDER BY id_asistencia DESC");

		$stmt->execute();

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	static public function mdlMostrarEmpleados($tabla)
	{

		$stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();
	}

	static public function mdlguardarEmpleado($tabla, $datos)
	{
		$stmt = conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellido, ci, cargo, num_tlf, direccion, fecha_ingreso, fecha_servicio, correo) VALUES (:NOMBRE, :APELLIDO, :CI, :CARGO, :TLF, :DIREC, :FECH, :SERV, :EMAIL)");

		$stmt->bindParam(":NOMBRE", $datos['nom_empleado'], PDO::PARAM_STR);
		$stmt->bindParam(":APELLIDO", $datos['ape_empleado'], PDO::PARAM_STR);
		$stmt->bindParam(":CI", $datos['ci_empleado'], PDO::PARAM_STR);
		$stmt->bindParam(":CARGO", $datos['carg_empleado'], PDO::PARAM_INT);
		$stmt->bindParam(":FECH", $datos['fecha_Empleado'], PDO::PARAM_STR);
		$stmt->bindParam(":TLF", $datos['telefono_Empleado'], PDO::PARAM_STR);
		$stmt->bindParam(":DIREC", $datos['direccion_Empleado'], PDO::PARAM_STR);
		$stmt->bindParam(":SERV", $datos['sevicio'], PDO::PARAM_STR);
		$stmt->bindParam(":EMAIL", $datos['correo_Empleado'], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			echo 'error';
		}

		$stmt->close();

		$stmt = null;
	}
}
