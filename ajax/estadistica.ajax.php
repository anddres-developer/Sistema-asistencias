<?php
require_once "../controlador/estadistica.controlador.php";
require_once "../modelo/estadistica.modelo.php";
require_once "../modelo/asistencia.modelo.php";
include "../config.php";

class AjaxEstadistica
{

    public function ajaxEstadistica()
    {
        $respuesta = ctrEstadistica::ctrMostrarEstadistica();
        echo json_encode($respuesta);
    }
}

//Mostrar estadistica

$mostrar = new AjaxEstadistica();
$mostrar->ajaxEstadistica();
