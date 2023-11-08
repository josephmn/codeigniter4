<?php

namespace App\Controllers;

use App\Libraries\StaticResource;

class inicio extends BaseController
{
    public function index(): string
    {
        // $staticResource = new StaticResource();

        // dth -> data header
        // dtf -> data footer

        // Agregar Título a la Vista
        $dth['pageTitle'] = 'Inicio';
        
        // Agregar archivos CSS
        $dth['css'] = array(
            'plugins/fontawesome-free/css/all.min.css',
            'dist/css/adminlte.min.css',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        );
        
        // Agregar archivos JS
        $dtf['js'] = array(
            'plugins/jquery/jquery.min.js',
            'plugins/jquery-ui/jquery-ui.min.js',
            'plugins/bootstrap/js/bootstrap.bundle.min.js',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'dist/js/adminlte.js',
        );

        $data['header'] = view('layout/header', $dth);
        $data['footer'] = view('layout/footer', $dtf);

        return view('home/index', $data);
    }
}