<?php

class ctrEstadistica
{

    static public function ctrMostrarEstadistica()
    {


        $tabla = "asistencia";

        $repuesta = mdlEstadistica::mdlEstadistias($tabla);

        return $repuesta;
    }
}
