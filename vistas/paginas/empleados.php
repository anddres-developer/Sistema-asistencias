<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Empleados</h1>
    <a href="vistas/fpdf/ReporteEmpleado.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i
            class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
</div>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#modal-crear-empleado">
            <span class="icon text-white-50">
                <i class="fas fa-user-plus"></i>
            </span>
            <span class="text">Registrar Empleado</span>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nº Cedula</th>
                        <th>Cargo</th>
                        <th>Fecha de Registro</th>
                        <th>Correo</th>
                        <th>Nº Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nº Cedula</th>
                        <th>Cargo</th>
                        <th>Fecha de Registro</th>
                        <th>Correo</th>
                        <th>Nº Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    foreach ($empleados as $key => $value) {

                        $item = "id_cargo";

                        $valor = $value["cargo"];

                        $cargo = ctrCargos::ctrMostrarCargos($item, $valor);
                    ?>

                        <tr>
                            <td><?php echo $value["id_empleado"] ?></td>
                            <td><?php echo $value["nombre"] ?></td>
                            <td><?php echo $value["apellido"] ?></td>
                            <td><?php echo $value["ci"] ?></td>
                            <td><?php echo $cargo["nombre"] ?></td>
                            <td><?php echo $value["fecha_ingreso"] ?></td>
                            <td><?php echo $value["correo"] ?></td>
                            <td><?php echo $value["num_tlf"] ?></td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning btn-sm mr-1 btnEditarEmpleado"
                                        data-toggle="modal" idEmpleado="<?php echo $value["id_empleado"] ?>"
                                        data-target="#modal-editar-empleado">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm eliminarEmpleado" idEmpleadoB="<?php echo $value["id_empleado"] ?>">
                                        <i class="fas fa-user-minus"></i>
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

<!-- Modal Crear Empleado -->
<div class="modal modal-default fade" id="modal-crear-empleado">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="alert alert-success alert-dismissible"> Agregar nuevo Empleado</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="text" class="form-control" id="nom_empleado" name="nom_empleado" placeholder="nombre">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="text" class="form-control" id="ape_empleado" name="ape_empleado" placeholder="apellido">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="text" class="form-control" id="ci_Empleado" name="ci_Empleado" placeholder="Numero de Cedula">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">

                        <label>Cargo</label>
                        <select name="carg_empleado" id="carg_empleado" class="form-control" required>
                            <?php
                            foreach ($cargos as $carg) {
                            ?>
                                <option value="<?php echo $carg['id_cargo'] ?>"><?php echo $carg['nombre'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <label for="">Fecha de Registro</label>
                        <input type="text" class="form-control" id="fecha_Empleado" name="fecha_Empleado" placeholder="2025-01-01">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>

                        <input type="text" class="form-control" id="telefono_Empleado" name="telefono_Empleado" placeholder="Numero de Telefono">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="text" class="form-control" id="direccion_Empleado" name="direccion_Empleado" placeholder="Direccion">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="text" class="form-control" id="año_Empleado" name="año_Empleado" placeholder="años de servicio">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="email" class="form-control" id="correo_Empleado" name="correo_Empleado" placeholder="Correo Electrónico">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
            <?php

            $guardarUsuarios = new ctrEmpleados();
            $guardarUsuarios->ctrGuardarEmpleado();

            ?>
            </form>

        </div>
    </div>
</div>

<!-- Modal Editar Empleado -->
<div class="modal modal-default fade" id="modal-editar-empleado">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="alert alert-success alert-dismissible">Editar Empleado</h4>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="hidden" id="id_empleado_ed" name="id_empleado_edE">
                        <input type="text" class="form-control" id="ed_nom_empleado" name="ed_nom_empleadoE" placeholder="nombre">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1">
                        <input type="text" class="form-control" id="ed_ape_empleado" name="ed_ape_empleadoE" placeholder="apellido">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="text" class="form-control" id="ed_ci_Empleado" name="ed_ci_EmpleadoE" placeholder="Numero de Cedula">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">

                        <label>Cargo</label>
                        <select name="ed_carg_empleadoE" id="ed_carg_empleado" class="form-control" required>
                            <?php
                            foreach ($cargos as $carg) {
                            ?>
                                <option value="<?php echo $carg['id_cargo'] ?>"><?php echo $carg['nombre'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <label for="">Fecha de Registro</label>
                        <input type="text" class="form-control" id="ed_fecha_EmpleadoE" name="ed_fecha_EmpleadoE" placeholder="2025-01-01">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="text" class="form-control" id="ed_telefono_Empleado" name="ed_telefono_EmpleadoE" placeholder="Numero de Telefono">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="text" class="form-control" id="ed_direccion_Empleado" name="ed_direccion_EmpleadoE" placeholder="Direccion">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="text" class="form-control" id="ed_servicio_EmpleadoE" name="ed_servicio_EmpleadoE" placeholder="años de servicio">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>

                    <div class="form-group has-feedback" bis_skin_checked="1" require>
                        <input type="email" class="form-control" id="ed_correo_Empleado" name="ed_correo_EmpleadoE" placeholder="Correo Electrónico">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Editar</button>
            </div>
            <?php

            $editarUsuarios = new ctrEmpleados();
            $editarUsuarios->ctrEditarEmpleados();

            ?>
            </form>

        </div>
    </div>

</div>