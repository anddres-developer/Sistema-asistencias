/*Editar Empleado*/

$(document).on("click", ".btnEditarEmpleado", function () {
  let idEmpleado = $(this).attr("idEmpleado");

  let datos = new FormData();

  datos.append("idEmpleado", idEmpleado);

  $.ajax({
    url: "ajax/empleados.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#id_empleado_ed").val(respuesta["id_empleado"]);
      $("#ed_nom_empleado").val(respuesta["nombre"]);
      $("#ed_ape_empleado").val(respuesta["apellido"]);
      $("#ed_ci_Empleado").val(respuesta["ci"]);
      $("#ed_carg_empleado").val(respuesta["cargo"]);
      $("#ed_fecha_EmpleadoE").val(respuesta["fecha_ingreso"]);
      $("#ed_telefono_Empleado").val(respuesta["num_tlf"]);
      $("#ed_direccion_Empleado").val(respuesta["direccion"]);
      $("#ed_servicio_EmpleadoE").val(respuesta["fecha_servicio"]);
      $("#ed_correo_Empleado").val(respuesta["correo"]);
    },
  });
});

/*Eliminar Empleado*/

$(document).on("click", ".eliminarEmpleado", function () {
  let idEmpleadoE = $(this).attr("idEmpleadoB");

  Swal.fire({
    title: "Estas seguro de eliminar a este empleado",
    text: "Si no estás seguro, puedes cancelar esta acción!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
  }).then((result) => {
    if (result.value) {
      let datos = new FormData();
      datos.append("idEmpleadoE", idEmpleadoE);

      $.ajax({
        url: "ajax/empleados.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta == "ok") {
            Swal.fire(
              "El Empleado",
              "fue eliminado correctamente",
              "success"
            ).then(function (result) {
              if (result.value) {
                window.location = "empleados";
              }
            });
          }
        },
      });
    }
  });
});
