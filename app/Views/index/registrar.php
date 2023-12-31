<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $_SERVER['NAME_APLICATION'];?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Aquí cargas tus archivos CSS comunes -->
    <?php foreach ($css as $cssFile): ?>
    <link rel="stylesheet" href="<?= $cssFile; ?>">
    <?php endforeach; ?>

</head>

<body class="hold-transition register-page">

    <div class="register-box">
        <div class="card card-outline card-secondary">
            <div class="card-header text-center">
                <!-- <a href="<?php //base_url() ?>" class="h1"><b>Netprodex</b></a> -->
                <div class="contenedor-imagen">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>/dist/img/netprodex_texto.png" width="300" height="70" alt="logo_texto">
                    </a>
                </div>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Por favor ingrese sus datos correspondientes en casa casilla para luego registrarse en el sistema</p>

                <form action="" method="post">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label font-weight-bolder">Tipo de documento:</label>
                            <div class="input-group mb-3">
                                <select id="tdocumento" tabindex="1" class="form-control form-control-md" onchange="actualizarLongitudMaxima()">
                                    <?php echo $this->data['combo'];?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <input id="documento" name="documento" tabindex="2" type="text" class="form-control" placeholder="Número de documento" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-id-card"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="nombres" tabindex="3" class="form-control" placeholder="Nombres" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" name="apellidos" tabindex="4" class="form-control" placeholder="Apellidos" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label font-weight-bolder">Correo electrónico:</label>
                            <div class="input-group mb-3">
                                <input type="email" name="correo" tabindex="5" class="form-control" placeholder="Correo" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password1" tabindex="6" class="form-control" placeholder="Password" autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password2" tabindex="7" class="form-control" placeholder="Repite password"
                                    autocomplete="off">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- <div class="col-7">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label class="pl-1" for="agreeTerms">Acepto los <a href="#">términos</a>
                                </label>
                            </div>
                        </div> -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-save mr-2 fa-beat"></i>Registrarme</button>
                        </div>
                    </div>
                </form>

                <div class="mt-2">
                    <a href="<?= base_url(); ?>" class="text-center">Ir a iniciar sesión</a>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- Aquí cargas tus archivos JS comunes -->
    <?php foreach ($js as $jsFile): ?>
    <script src="<?= $jsFile; ?>"></script>
    <?php endforeach; ?>
</body>

</html>