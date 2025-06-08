<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Cargos</h1>
    <a href="/vistas/fpdf/ReporteCargo.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i
            class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#modal-crear-cargo">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Registrar Cargo</span>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($cargos as $key => $value) {

                    ?>
                        <tr>
                            <td><?php echo $value["id_cargo"] ?></td>
                            <td><?php echo $value["nombre"] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button
                                        class="btn btn-danger btn-sm eliminarCargo"
                                        idCargo="<?php echo $value["id_cargo"] ?>">
                                        <i class="fa fa-trash text-white"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!--Modal Crear Cargos-->
<div class="modal modal-default fade" id="modal-crear-cargo">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible">Agregar nuevo Cargo</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="text" class="form-control" name="nom_cargo" placeholder="nombre del Cargo">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                    <?php

                    $guardarRol = new ctrCargos();
                    $guardarRol->ctrGuardarCargo();

                    ?>
                </form>
            </div>
        </div>
    </div>

</div>

<script src="vistas/js/cargos.js"></script>