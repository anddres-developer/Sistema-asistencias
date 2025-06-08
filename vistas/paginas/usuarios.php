<div class="d-sm-flex align-items-center justify-content-between mb-4">
	<h1 class="h3 mb-4 text-gray-800">Usuarios</h1>
	<a href="vistas/fpdf/ReporteUsuario.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" target="_blank"><i
			class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
</div>

<div class="card shadow mb-4">
	<div class="card-header py-3">
		<button type="button" class="btn btn-primary btn-icon-split" data-toggle="modal" data-target="#modal-crear-usuarios">
			<span class="icon text-white-50">
				<i class="fas fa-user-plus"></i>
			</span>
			<span class="text">Registrar Usuario</span>
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
						<th>Correo Electrónico</th>
						<th>Usuario</th>
						<th>Rol</th>
						<th>Foto</th>
						<th>Acciones</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Correo Electrónico</th>
						<th>Usuario</th>
						<th>Rol</th>
						<th>Foto</th>
						<th>Acciones</th>
					</tr>
				</tfoot>
				<tbody>
					<?php
					foreach ($usuarios as $key => $value) {

						$item = "id_roles";

						$valor = $value["rol"];

						$roles = ctrRoles::ctrMostrarRoles($item, $valor);
					?>

						<tr>
							<td><?php echo $value["id"] ?></td>
							<td><?php echo $value["nombre"] ?></td>
							<td><?php echo $value["apellido"] ?></td>
							<td><?php echo $value["email"] ?></td>
							<td><?php echo $value["usuario"] ?></td>
							<td><?php echo $roles["nom_rol"] ?></td>
							<td><img src="<?php echo $value["foto"] ?>" width="40" height="40" alt="foto de perfil"></td>
							<!--<td><button class="btn btn-info btm-sm">Activo</button></td>-->
							<td>
								<div class="btn-group">
									<button class="btn btn-warning btn-sm mr-1 btnEditarUsuario"
										data-toggle="modal" idUsuario="<?php echo $value["id"] ?>"
										data-target="#modal-editar-usuarios">
										<i class="fas fa-pen"></i>
									</button>
									<button class="btn btn-danger btn-sm eliminarUsuario" idUsuarioE="<?php echo $value["id"] ?>" rutaFoto="<?php echo $value["foto"]; ?>">
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

<!-- Modal Crear Usuarios -->
<div class="modal modal-default fade" id="modal-crear-usuarios">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="alert alert-success alert-dismissible"> Agregar nuevo usuario</h4>
			</div>
			<div class="modal-body">
				<form method="post" enctype="multipart/form-data">
					<div class="form-group has-feedback" bis_skin_checked="1">
						<input type="text" class="form-control" name="nom_usuario" placeholder="Nombre">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback" bis_skin_checked="1">
						<input type="text" class="form-control" name="ape_usuario" placeholder="Apellido">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback" bis_skin_checked="1">
						<input type="text" class="form-control" name="nom_user" placeholder="Nombre de Usuario">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback" bis_skin_checked="1">
						<input type="email" class="form-control" name="mail_user" placeholder="Correo Electrónico">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback" bis_skin_checked="1">
						<input type="password" class="form-control" name="pass_user" placeholder="Contraseña">
						<span class="glyphicon glyphicon-eye-open form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback" bis_skin_checked="1">
						<div class="btn btn-default btn-file" bis_skin_cheched="1">
							<i class="fa fa-paperclip"></i> Adjuntar Imagen de Perfil
							<input type="file" name="subirImgUsuario">
						</div>
						<img class="previsualizarImgUser img-fluid py-2" width="200" height="200">
						<p class="help-block small">Dimenciones: 480px * 382px | Peso Max. 2MB | Formato: JPG PNG</p>
					</div>
					<div class="form-group has-feedback">

						<label>role</label>
						<select name="rol_user" class="form-control" required>
							<?php
							$roles = ctrRoles::ctrMostrarRoles2();
							foreach ($roles as $rol) {
							?>
								<option value="<?php echo $rol['id_roles'] ?>"><?php echo $rol['nom_rol'] ?></option>
							<?php
							}
							?>
						</select>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
			<?php

			$guardarUsuarios = new ctrUsuarios();
			$guardarUsuarios->ctrGuardarusuarios();

			?>
			</form>

		</div>
	</div>
</div>

<!-- Modal Editar Usuario -->
<div class="modal modal-default fade" id="modal-editar-usuarios">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="alert alert-success alert-dismissible">Editar usuario</h4>
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

						<label>Rol</label>
						<select name="ed_rol_user" class="form-control" required>
							<?php
							foreach ($roles as $rol) {
							?>
								<option value="<?php echo $rol['id_roles'] ?>"><?php echo $rol['nom_rol'] ?></option>
							<?php
							}
							?>
						</select>
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