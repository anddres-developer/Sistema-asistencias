/*Eliminar Cargo*/

$(document).on("click", ".eliminarAsistencia", function () {
  let idAsistenciaE = $(this).attr("idAsistenciaE");

  Swal.fire({
    title: "Estas seguro de eliminar a esta asistencia",
    text: "Si no estás seguro, puedes cancelar esta acción!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
  }).then((result) => {
    if (result.value) {
      let datos = new FormData();
      datos.append("idAsistenciaE", idAsistenciaE);

      $.ajax({
        url: "ajax/asistencias.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta == "ok") {
            Swal.fire(
              "La asistencia",
              "fue eliminado correctamente",
              "success"
            ).then(function (result) {
              if (result.value) {
                window.location = "asistencias";
              }
            });
          }
        },
      });
    }
  });
});
