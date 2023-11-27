<?php

namespace App\Controllers;
use App\Libraries\Resource;
use App\Libraries\Webservices;
use App\Libraries\Menu;

class Login extends BaseController
{
    public function index(): string
    {
        $resource = new Resource();
        // Agregar archivos CSS
        $css = array(
            'plugins/fontawesome-free/css/all.min',
            'dist/css/adminlte.min',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min',
        );

        // Agregar archivos JS
        $js = array(
            'plugins/fontawesome-free/js/all.min',
            'plugins/jquery/jquery.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/bootstrap/js/bootstrap.bundle.min',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
            'dist/js/adminlte',
        );
        
        $resource->addCss($css);
        $resource->addJs($js);
        
        $data['css'] = $resource->getCss();
        $data['js'] = $resource->getJs();

        return view('index/login', $data);
    }

    public function registrar(): string
    {
        $resource = new Resource();
        // Agregar archivos CSS
        $css = array(
            'plugins/fontawesome-free/css/all.min.css',
            'dist/css/adminlte.min.css',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        );
        
        // Agregar archivos JS
        $js = array(
            'plugins/fontawesome-free/js/all.min.js',
            'plugins/jquery/jquery.min.js',
            'plugins/jquery-ui/jquery-ui.min.js',
            'plugins/bootstrap/js/bootstrap.bundle.min.js',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'dist/js/adminlte.js',
        );

        $resource->addCss($css);
        $resource->addJs($js);
        
        $data['css'] = $resource->getCss();
        $data['js'] = $resource->getJs();

        return view('index/registrar', $data);
    }

    public function recuperar(): string
    {
        $resource = new Resource();
        // Agregar archivos CSS
        $css = array(
            'plugins/fontawesome-free/css/all.min.css',
            'dist/css/adminlte.min.css',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        );
        
        // Agregar archivos JS
        $js = array(
            'plugins/fontawesome-free/js/all.min.js',
            'plugins/jquery/jquery.min.js',
            'plugins/jquery-ui/jquery-ui.min.js',
            'plugins/bootstrap/js/bootstrap.bundle.min.js',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
            'dist/js/adminlte.js',
        );

        $resource->addCss($css);
        $resource->addJs($js);
        
        $data['css'] = $resource->getCss();
        $data['js'] = $resource->getJs();

        return view('index/recuperar', $data);
    }

    public function login() {
        
        $servicio = new Webservices();

        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

		$wsdl = $servicio->getWS();
        $options = $servicio->getOptions();
		
		$param = array(
			"usuario"=>$usuario,
			"password"=>$password,
		);

        $soap = new \SoapClient($wsdl, $options);
        
        // Para obtener datos del login
        $result_login = $soap->Login($param);
        $data_login = json_decode($result_login->LoginResult,true);
        
        // echo '<pre>';
        // print_r($data['Resultado'][0]['dt_usuario']);
        // print_r($data['Resultado'][0]['dt_perfil']);
        // echo '</pre>';
        // exit;
        
        if (!empty($data_login) || count($data_login) > 0) {
            
            $session = session();
            // Establecer el valor en la sesión
            $session->set('Resultado', $data_login['Resultado'][0]);
            $session->set('dt_usuario', $data_login['Resultado'][0]['dt_usuario'][0]);
            $session->set('dt_perfil', $data_login['Resultado'][0]['dt_perfil'][0]);
            
            $perfil = $data_login['Resultado'][0]['dt_perfil'][0]['i_id'];
            // Para obtener el listado de menú
            $prm_perfil = array(
                "post" => 0, // 0 -> Lista de menu login, 1 -> Listado de menu por perfil
                "perfil"=> $perfil,
            );

            $result_menu = $soap->Menu($prm_perfil);
            $data_menu = json_decode($result_menu->MenuResult,true);
            
            $ls_menu = $data_menu['Resultado'];
            $session->set('list_menu', $data_menu['Resultado']);
            
            $menu = new Menu();
            $menu->postMenu($ls_menu, "inicio");

            return redirect()->to(base_url('/inicio'));
        } else {
            return redirect()->to(base_url('/'))->with('mensaje','Usuario no encontrado o clave incorrecta');
        }
    }

    public function salir() {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}