<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Perfil</h1>
    <button type="button" class="btn btn-primary btn-icon-split btnEditarUsuario" data-toggle="modal" idUsuario="<?php echo $admin["id"] ?>" data-target="#modal-editar-perfil">
        <span class="icon text-white-50">
            <i class="fas fa-pencil-alt fa-sm text-white-50"></i>
        </span>
        <span class="text">Editar Perfil</span>
    </button>
</div>

<div class="row">

    <!-- Imagen de perfil -->
    <div class="col-xl-4 col-lg-5">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Imagen de Perfil</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="containee pt-4 pb-2 text-center">
                    <img src="<?php echo $admin['foto']; ?>" class="img-fluid rounded-circle" width="285" height="208" alt="Imagen de perfil">
                </div>
                <div class="mt-4 text-center small">
                    <h6 class="m-0 font-weight-bold text-dark"><?php echo $admin['nombre'] ?> <?php echo $admin['apellido'] ?></h6> <br>
                    <?php if ($admin['rol'] == 'Administrador') { ?>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Administrador.
                        </span>
                    <?php } else { ?>
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Empleado.
                        </span>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

    <!-- Datos del usuario -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Datos del Usuario</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Correo Electronico</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $admin['email']; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="far fa-envelope fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Nombre de Usuario</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $admin['usuario']; ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="far fa-user fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal para editar perfil -->

<div class="modal modal-default fade" id="modal-editar-perfil">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible">Editar perfil</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="hidden" id="ed_idPerfil" name="ed_idPerfil">
                        <input type="text" class="form-control" id="ed_nom_usuario" name="ed_nom_usuario" placeholder="Nombre">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="text" class="form-control" id="ed_ape_usuario" name="ed_ape_usuario" placeholder="Apellido">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="text" class="form-control" id="ed_nom_user" name="ed_nom_user" placeholder="Nombre de Usuario">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="email" class="form-control" id="ed_mail_user" name="ed_mail_user" placeholder="Correo Electrónico">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="hidden" id="pass_useractual" name="pass_useractual">
                        <input type="password" class="form-control" id="ed_pass_user" name="ed_pass_user" placeholder="Contraseña">
                        <span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <div class="btn btn-default btn-file" bis_skin_cheched="1">
                            <i class="fa fa-paperclip"></i> Adjuntar Imagen de Perfil
                            <input type="file" name="ed_subirImgUsuario" id="ed_subirImgUsuario">
                        </div>
                        <input type="hidden" id="fotoActualE" name="fotoActualE">
                        <img class="previsualizarImgUser img-fluid py-2" width="200" height="200">
                        <p class="help-block small">Dimenciones: 480px * 382px | Peso Max. 2MB | Formato: JPG PNG</p>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="hidden" id="ed_rol_user" name="ed_rol_user" value="<?php echo $admin['rol'] ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            <?php

            $editarUsuarios = new ctrUsuarios();
            $editarUsuarios->ctrEditaruarios();

            ?>
            </form>

        </div>
    </div>

</div>

<script src="vistas/js/usuarios.js"></script>