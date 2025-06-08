<body class="bg-gradient-primary">
    <?php
    include_once "modelo/conexion.php";
    include_once "controlador/controlador-registrar-asistencia.php";
    date_default_timezone_set("America/caracas");
    ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-7 col-lg-6 col-md-9">
                <div class="text-center m-5">
                    <h1 class="h2 mb-2 text-white">Bienvenido, registra tu asistencia</h1>
                    <h2 class="h4 mb-2 text-white" id="fecha"><?= date("d/m/Y, h:i:s") ?></h2>

                </div>

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h2 class="h4 text-gray-900 mb-2">Ingresar Cedula de identidad</h2>
                                        <br>
                                    </div>
                                    <form class="user" method="post">
                                        <div class="form-group">
                                            <input type="number" class="form-control form-control-user"
                                                aria-describedby="emailHelp" placeholder="Numero de cedula" name="txtci" id="txtci">
                                        </div>

                                        <div class="btn-group d-flex justify-content-between">
                                            <button type="submit" class="btn btn-success btn-user entrada" name="btnentrada" value="ok">Entrada</button>
                                            <button type="submit" class="btn btn-danger btn-user salida" name="btnsalida" value="ok">Salida</button>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="login">¡Iniciar sesión!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        setInterval(() => {
            let fecha = new Date();
            let fechahora = fecha.toLocaleString();
            document.getElementById("fecha").textContent = fechahora;
        }, 1000);

        let ci = document.getElementById("txtci");
        if (typeof ci !== "undefined") {
            ci.addEventListener("input", function() {
                if (this.value.length >= 7) {
                    this.value = this.value.slice(0, 8)
                }
            });
        }
    </script>

</body>