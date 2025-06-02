<?php
//include '../config.php';
class conexion
{
	static public function conectar()
	{
		$host = $_ENV['DB_HOST'];
		$dbname = $_ENV['DB_NAME'];
		$user = $_ENV['DB_USER'];
		$password = $_ENV['DB_PASSWORD'];


		$link = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

		$link->exec("set names utf8mb4");

		return $link;
	}
}
