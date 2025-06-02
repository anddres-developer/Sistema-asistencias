<?php

include "../config.php";

$host = $_ENV['DB_HOST']; //Host del Servidor MySQL
$dbname = $_ENV['DB_NAME']; //Nombre de la Base de datos
$user = $_ENV['DB_USER']; //Usuario de MySQL
$password = $_ENV['DB_PASSWORD']; //Password de Usuario MySQL

date_default_timezone_set('UTC');

$fecha = date("Ymd-His"); //Obtenemos la fecha y hora para identificar el respaldo

// Construimos el nombre de archivo SQL Ejemplo: mibase_20170101-081120.sql
$salida_sql = $dbname . '_' . $fecha . '.sql';

//Comando para genera respaldo de MySQL, enviamos las variales de conexion y el destino
$dump = "mysqldump -h $host -u $user -p$password --opt $dbname > $salida_sql";
system($dump, $output); //Ejecutamos el comando para respaldo

$zip = new ZipArchive(); //Objeto de Libreria ZipArchive

//Construimos el nombre del archivo ZIP Ejemplo: mibase_20160101-081120.zip
$salida_zip = $dbname . '_' . $fecha . '.zip';

if ($zip->open($salida_zip, ZIPARCHIVE::CREATE) === true) { //Creamos y abrimos el archivo ZIP
	$zip->addFile($salida_sql); //Agregamos el archivo SQL a ZIP
	$zip->close(); //Cerramos el ZIP
	unlink($salida_sql); //Eliminamos el archivo temporal SQL
	header("Location: $salida_zip"); // Redireccionamos para descargar el Arcivo ZIP
} else {
	echo 'Error'; //Enviamos el mensaje de error
}
