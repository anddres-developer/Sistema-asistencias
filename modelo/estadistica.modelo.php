<?php

require_once "coneccion.php";

class mdlEstadistica
{
    public static function mdlEstadistias($tabla)
    {
        $stmt = conexion::conectar()->prepare("SELECT entrada FROM $tabla WHERE entrada LIKE '%-' :MES '-%'");
        $resultado = [];
        for ($i = 1; $i <= 12; $i++) {
            $valor = sprintf("%02d", (string)$i);

            $stmt->bindParam(':MES', $valor);
            $stmt->execute();
            $resultado[] = $stmt->rowCount();
        }

        return $resultado;
    }
}
