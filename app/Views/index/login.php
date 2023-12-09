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

<body class="hold-transition login-page">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-secondary">
            <div class="card-header text-center">
                <!-- <a href="<?php //base_url() ?>" class="h1"><b>Netprodex</b></a> -->
                <div class="contenedor-imagen">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url() ?>dist/img/netprodex_texto.png" alt="logo_texto">
                    </a>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url("/login"); ?>" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" name="usuario" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-secondary btn-block">Ingresar <i
                                    class="ml-1 fas fa-sign-in-alt"></i></button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-2 mb-1">
                    <a href="<?= base_url("recuperar"); ?>">Olvide mi clave</a>
                </p>
                <p class="mb-0">
                    <a href="<?= base_url("registrar"); ?>" class="text-center">Soy nuevo, quiero registrarme</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- Aquí cargas tus archivos JS comunes -->
    <?php foreach ($js as $jsFile): ?>
    <script src="<?= $jsFile; ?>"></script>
    <?php endforeach; ?>
</body>

</html>