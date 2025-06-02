<?php
require_once "../controlador/cargos.controlador.php";
require_once "../modelo/cargos.modelo.php";
include "../config.php";

class AjaxCargos
{

    public $idCargos;

    public function ajaxEditarRoles()
    {

        $item = "id_cargos";
        $valor = $this->idCargos;

        $respuesta = ctrCargos::ctrVerCargo($item, $valor);

        echo json_encode($respuesta);
    }


    public $idCargoE;

    public function ajaxEliminarRoles()
    {

        $valor = $this->idCargoE;

        $respuesta = ctrCargos::ctrEliminarCargo($valor);
        echo json_encode($respuesta);
    }
}

//Editar Cargos

if (isset($_POST["idCargos"])) {

    $editar = new AjaxCargos();
    $editar->idCargos = $_POST["idCargos"];
    $editar->ajaxEditarRoles();
}

//Eliminar Cargo

if (isset($_POST["idCargoE"])) {

    $eliminar = new AjaxCargos();
    $eliminar->idCargoE = $_POST["idCargoE"];
    $eliminar->ajaxEliminarRoles();
}
