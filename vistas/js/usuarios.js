/*Subir imagen temporal usuarios*/
$("input[name='subirImgUsuario']").change(function () {
  var imagen = this.files[0];

  //validar formulario

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $("input[name='subirImgUsuario']").val("");

    swal.fire({
      icon: "error",
      title: "Error al subir imagen",
      text: "¡La imagen debe estar en el formato jpg o png!",
      confirmButtonColor: "#d33",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $("input[name='subirImgUsuario']").val("");

    swal.fire({
      icon: "error",
      title: "Error al subir imagen",
      text: "¡la imagen no debe pesar más de 2MB",
      confirmButtonColor: "#d33",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;

      $(".previsualizarImgUser").attr("src", rutaImagen);
    });
  }
});

/*Subir imagen temporal editar usuarios*/

$("input[name='ed_subirImgUsuario']").change(function () {
  var imagen = this.files[0];

  //validar formulario

  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $("input[name='ed_subirImgUsuario']").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $("input[name='ed_subirImgUsuario']").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;

      $(".previsualizarImgUser").attr("src", rutaImagen);
    });
  }
});

/*Editar Usuarios*/

$(document).on("click", ".btnEditarUsuario", function () {
  var idUsuario = $(this).attr("idUsuario");

  var datos = new FormData();

  datos.append("idUsuario", idUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#ed_idPerfil").val(respuesta["id"]);
      $("#ed_nom_usuario").val(respuesta["nombre"]);
      $("#ed_ape_usuario").val(respuesta["apellido"]);
      $("#ed_nom_user").val(respuesta["usuario"]);
      $("#ed_mail_user").val(respuesta["email"]);
      $("#ed_pass_user").val(respuesta["password"]);
      $(".previsualizarImgUser").attr("src", respuesta["foto"]);
      $("#fotoActualE").val(respuesta["foto"]);
      $("#pass_useractual").val(respuesta["password"]);
      $("#ed_subirImgUsuario").val("");
      //$("input[name='ed_subirImgUsuario']").val(respuesta["foto"]);
    },
  });
});

/*Eliminar usuairo*/
$(document).on("click", ".eliminarUsuario", function () {
  var idUsuario = $(this).attr("idUsuarioE");
  var rutaFoto = $(this).attr("rutaFoto");

  Swal.fire({
    title: "Estas seguro de eliminar a este usuario",
    text: "Si no estás seguro puedes cancelar esta acción!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Si, eliminar",
  }).then((result) => {
    if (result.value) {
      var datos = new FormData();
      datos.append("idUsuarioE", idUsuario);
      datos.append("rutaFoto", rutaFoto);

      $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          if (respuesta == "ok") {
            Swal.fire(
              "Usuario eliminado",
              "El usuario fue eliminado correctamente",
              "success"
            ).then(function (result) {
              if (result.value) {
                window.location = "usuarios";
              }
            });
          }
        },
      });
    }
  });
});
