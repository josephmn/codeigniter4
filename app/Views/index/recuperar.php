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
        <div class="card card-outline card-success">
            <div class="card-header text-center">
                <a href="<?= base_url() ?>" class="h1"><b>Netprodex</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Favor ingrese su correo electrónico registrado en el sistema para recuperar la clave.</p>

                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Ingrese correo" autocomplete="off">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block">Enviar correo</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="mt-2">
                    <a href="<?= base_url(); ?>" class="text-center">Ir a iniciar sesión</a>
                </div>
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