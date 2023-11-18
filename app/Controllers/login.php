<?php

namespace App\Controllers;
use App\Libraries\Resource;

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
        
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');

		$wsdl = 'http://localhost:60714/wsNetprodex.asmx?WSDL';

		$options = array(
			"uri"=> $wsdl,
			"style"=> SOAP_RPC,
			"use"=> SOAP_ENCODED,
			"soap_version"=> SOAP_1_1,
			"connection_timeout"=> 60,
			"trace"=> false,
			"encoding"=> "UTF-8",
			"exceptions"=> false,
			);
		
		$param = array(
			"usuario"=>$usuario,
			"password"=>$password,
		);

        $soap = new \SoapClient($wsdl, $options);
        $result = $soap->Login($param);

        $data = json_decode($result->LoginResult,true);

        // echo '<pre>';
        // print_r($data['Resultado'][0]['dt_usuario']);
        // print_r($data['Resultado'][0]['dt_perfil']);
        // echo '</pre>';
        // exit;

        if (!empty($data) || count($data) > 0) {
            
            $session = session();
            // Establecer el valor en la sesión
            $session->set('Resultado', $data['Resultado'][0]);
            $session->set('dt_usuario', $data['Resultado'][0]['dt_usuario'][0]);
            $session->set('dt_perfil', $data['Resultado'][0]['dt_perfil'][0]);

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