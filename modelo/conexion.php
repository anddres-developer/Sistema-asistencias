<?php
//include '../config.php';
$host = $_ENV['DB_HOST'];
$dbname = $_ENV['DB_NAME'];
$user = $_ENV['DB_USER'];
$password = $_ENV['DB_PASSWORD'];
$port = $_ENV['DB_PORT'];

$conexion = new mysqli($host, $user, $password, $dbname, $port);
$conexion->set_charset("utf8");
date_default_timezone_set("America/caracas");
