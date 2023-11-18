<?= $header ?>

<h2>Este es home</h2>

<?php 

    echo '<pre>';
    print_r(session('dt_usuario'));
    print_r(session('dt_perfil'));
    echo '</pre>';

?>

<?php //print_r(session('dt_perfil'));?>

<?= $footer ?>