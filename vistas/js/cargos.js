/*Eliminar Cargo*/

$(document).on("click", ".eliminarCargo", function () {
  let idCargoE = $(this).attr("idCargo");

  Swal.fire({
    title: "Estas seguro de eliminar a este Cargo",
    text: "Si no estás seguro, puedes cancelar esta acción!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
  }).then((result) => {
    if (result.value) {
      let datos = new FormData();
      datos.append("idCargoE", idCargoE);

      $.ajax({
        url: "ajax/cargos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta == "ok") {
            Swal.fire(
              "El cargo",
              "fue eliminado correctamente",
              "success"
            ).then(function (result) {
              if (result.value) {
                window.location = "cargos";
              }
            });
          }
        },
      });
    }
  });
});
