<?php

include "../config.php";
$host = $_ENV['DB_HOST']; //Host del Servidor MySQL
$dbname = $_ENV['DB_NAME']; //Nombre de la Base de datos
$user = $_ENV['DB_USER']; //Usuario de MySQL
$password = $_ENV['DB_PASSWORD']; //Password de Usuario MySQL

// Verificar si se envió el archivo
if (isset($_FILES['archivo_sql']) && $_FILES['archivo_sql']['error'] === UPLOAD_ERR_OK) {
    $archivo_temporal = $_FILES['archivo_sql']['tmp_name'];
    $nombre_archivo = $_FILES['archivo_sql']['name'];

    // Leer el contenido del archivo SQL
    $contenido_sql = file_get_contents($archivo_temporal);

    // Dividir el contenido del archivo en consultas individuales (considerando el punto y coma como delimitador)
    $consultas = explode(";", $contenido_sql);

    // Conectar a la base de datos
    $conn = new mysqli($host, $user, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    $errores = [];
    $consultas_ejecutadas = 0;

    // Ejecutar cada consulta
    foreach ($consultas as $consulta) {
        $consulta = trim($consulta); // Eliminar espacios en blanco al inicio y al final
        if (!empty($consulta)) {
            if ($conn->query($consulta) === TRUE) {
                $consultas_ejecutadas++;
            } else {
                $errores[] = "Error al ejecutar la consulta: " . $consulta . " - Error: " . $conn->error;
            }
        }
    }

    // Cerrar la conexión
    $conn->close();

    // Mostrar resultados
    if (empty($errores)) {
        echo "<p style='color: green;'>Base de datos importada exitosamente. Se ejecutaron " . $consultas_ejecutadas . " consultas.</p>" . "<script>setTimeout(function(){ window.history.back(); }, 1000);</script>";
    } else {
        echo "<p style='color: red;'>Se encontraron errores durante la importación:</p>";
        echo "<ul>";
        foreach ($errores as $error) {
            echo "<li>" . htmlspecialchars($error) . "</li>";
        }
        echo "</ul>";
    }
} else {
    echo "<p style='color: red;'>Por favor, selecciona un archivo .sql válido.</p>";
}
