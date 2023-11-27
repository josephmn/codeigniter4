<?php

namespace App\Controllers;
use App\Libraries\Resource;
use App\Libraries\Menu;

class perfil extends BaseController
{
    public function index(): string
    {
        $resource = new Resource();

        $menu = new Menu();
        $menu->postMenu(session('list_menu'), "perfil");

        $data['pageTitle'] = 'Perfil';
        
        $css = array(
            'plugins/fontawesome-free/css/all.min',
            'dist/css/adminlte.min',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min',
        );
        
        $js = array(
            'plugins/jquery/jquery.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/bootstrap/js/bootstrap.bundle.min',
            'plugins/fontawesome-free/js/all.min',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
            'dist/js/adminlte',
        );

        $resource->addCss($css);
        $resource->addJs($js);

        $data['css'] = $resource->getCss();
        $data['js'] = $resource->getJs();

        $data['header'] = view('layout/header', $data);
        $data['footer'] = view('layout/footer', $data);

        return view('perfil/index', $data);
    }
}