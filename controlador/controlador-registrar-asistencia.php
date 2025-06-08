<?php

if (isset($_POST["btnentrada"])) {
    if (isset($_POST["txtci"])) {
        $ci = $_POST["txtci"];
        $consulta = $conexion->query(" select count(*) as 'total' from empleado where ci='$ci' ");
        $id = $conexion->query(" select id_empleado from empleado where ci='$ci' ");
        if ($consulta->fetch_object()->total > 0) {

            $fecha = date("y-m-d h:i:s");
            $id_empleado = $id->fetch_object()->id_empleado;
            $sql = $conexion->query(" insert into asistencia(id_empleado,entrada)values($id_empleado,'$fecha') ");
            if ($sql == true) { ?>
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "CORRECTO",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            <?php } else { ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            <?php }
        } else { ?>
            <script>
                Swal.fire({
                    icon: "error",
                    title: "La cedula ingresada no existe",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php }
    } else { ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Ingrese la cedula",
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    <?php } ?>

<?php }

?>

<!---- REGISTRO DE SALIDA ---->

<?php
if (!empty($_POST["btnsalida"])) {
    if (!empty($_POST["txtci"])) {
        $ci = $_POST["txtci"];
        $consulta = $conexion->query(" select count(*) as 'total' from empleado where ci='$ci' ");
        $id = $conexion->query(" select id_empleado from empleado where ci='$ci' ");
        if ($consulta->fetch_object()->total > 0) {

            $fecha = date("Y-m-d h:i:s");
            $id_empleado = $id->fetch_object()->id_empleado;
            $busqueda = $conexion->query(" select id_asistencia from asistencia where id_empleado=$id_empleado order by id_asistencia desc limit 1 ");
            $id_asistencia = $busqueda->fetch_object()->id_asistencia;
            $sql = $conexion->query(" update asistencia set salida='$fecha' where id_asistencia=$id_asistencia ");
            if ($sql == true) { ?>
                <script>
                    Swal.fire({
                        icon: "success",
                        title: "Adios, Vuelve pronto!!",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            <?php } else { ?>
                <script>
                    Swal.fire({
                        icon: "error",
                        title: "Error al registrar SALIDA",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
            <?php }
        } else { ?>
            <script>
                Swal.fire({
                    icon: "error",
                    title: "La cedula ingresada no existe",
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        <?php }
    } else { ?>
        <script>
            $(function notificacion() {
                Swal.fire({
                    icon: "error",
                    title: "Ingrese la cedula",
                    showConfirmButton: false,
                    timer: 1500
                });
            })
        </script>
    <?php } ?>

<?php }

?>