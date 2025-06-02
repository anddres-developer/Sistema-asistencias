<?php
require_once "../controlador/empleados.controlador.php";
require_once "../modelo/empleados.modelo.php";
include "../config.php";

class AjaxEmpleados
{

    public $idEmpleado;

    public function ajaxEditarEmpleado()
    {

        $item = "id_empleado";
        $valor = $this->idEmpleado;

        $respuesta = ctrEmpleados::ctrMostrarEmpleados1($item, $valor);

        echo json_encode($respuesta);
    }

    public $borrar;

    public function ajasxEliminarEmpleado()
    {
        $item = "id_empleado";
        $valor = $this->borrar;
        $respuesta = ctrEmpleados::ctrEliminarEmpleados($item, $valor);
        echo json_encode($respuesta);
    }
}

//Editar usuario

if (isset($_POST["idEmpleado"])) {

    $editar = new AjaxEmpleados();
    $editar->idEmpleado = $_POST["idEmpleado"];
    $editar->ajaxEditarEmpleado();
}

//eliminar

if (isset($_POST["idEmpleadoE"])) {

    $eliminaEmpleado = new AjaxEmpleados();
    $eliminaEmpleado->borrar = $_POST["idEmpleadoE"];
    $eliminaEmpleado->ajasxEliminarEmpleado();
}
