<?= $header ?>

<h2>Este es Inicio</h2>

<?php 

    echo '<pre>';
    print_r(session('dt_usuario'));
    
    print_r(session('dt_perfil'));

    print_r(session('list_menu'));
    
    // print_r(session('menu'));
    echo '</pre>';

?>

<?php //print_r(session('dt_perfil'));?>

<?= $footer ?>