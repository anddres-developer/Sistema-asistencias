<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-4 text-gray-800">Respaldo de la base de datos</h1>
</div>

<div class="row">

    <div class="col-lg-6">
        <!-- Basic Card Example -->
        <div class="card shadow mb-4 border-bottom-warning">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Importar Base de Satos</h5>
            </div>
            <div class="card-body">
            <form method="POST" action="respaldo/importar_db.php" enctype="multipart/form-data">
                <div class="input-group">
                <div class="custom-file mr-1">
                    <input type="file" class="custom-file-input" id="importarDB" aria-describedby="importar">
                    <label class="custom-file-label" for="inputGroupFile04">Seleccione Archivo .sql</label>
                </div>
                <div class="input-group-append">
                    <button class="btn btn-warning btn-icon-split" type="button" id="importar">
                        <span class="icon text-white-50"><i class="fas fa-exclamation-triangle"></i></span> 
                        <span class="text">Importar Base de datos</span></button>
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4 border-bottom-success">
            <div class="card-header py-3">
                <h5 class="m-0 font-weight-bold text-primary">Exportar Base de Datos</h5>
            </div>
            <div class="card-body text-center">
                <a href="respaldo/exportar_db.php" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                    <i class="fas fa-download"></i>
                    </span>
                    <span class="text">Exportar base de datos</span>
                </a>
            </div>
        </div>
    </div>

</div>