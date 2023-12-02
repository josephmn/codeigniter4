<?php

namespace App\Controllers;
use App\Libraries\Resource;
use App\Libraries\Webservices;
use App\Libraries\Menu;

class configuracion extends BaseController
{
    public function conperfiles(): string
    {
        $resource = new Resource();

        $menu = new Menu();
        $menu->postMenu(session('list_menu'), "configuracion", "conperfiles");

        $data['pageTitle'] = 'Perfiles';
        
        $css = array(
            'plugins/fontawesome-free/css/all.min',
            'dist/css/adminlte.min',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min',
            'dist/css/myStyle',
            
            // DataTables
            // 'plugins/datatables-bs4/css/dataTables.bootstrap4.min',
            // 'plugins/datatables-responsive/css/responsive.bootstrap4',
            // 'plugins/datatables-responsive/css/responsive.bootstrap4.min',
            // 'plugins/datatables-buttons/css/buttons.bootstrap4.min',

            // DataTables 1.13.8
            'plugins/DataTables-1.13.8/css/jquery.dataTables.min',
            'plugins/DataTables-1.13.8/Responsive-2.5.0/css/responsive.dataTables.min',
            
            // Sweetalert2
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min',
            
            // Toast
            'plugins/toastr/toastr.min',
        );
        
        $js = array(
            // 'plugins/jquery/jquery.min',
            'plugins/jquery/jquery-3.7.0.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/bootstrap/js/bootstrap.bundle.min',
            'plugins/fontawesome-free/js/all.min',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
            'dist/js/adminlte',
            'plugins/js/globales',
            'plugins/js/perfiles/perfiles',

            // DataTables
            // 'plugins/datatables/jquery.dataTables.min',
            // 'plugins/datatables-bs4/js/dataTables.bootstrap4.min',
            // 'plugins/datatables-responsive/js/dataTables.responsive.min',
            // 'plugins/datatables-responsive/js/responsive.bootstrap4.min',
            // 'plugins/datatables-buttons/js/dataTables.buttons.min',
            // 'plugins/datatables-buttons/js/buttons.bootstrap4.min',

            // DataTables 1.13.8
            'plugins/DataTables-1.13.8/js/jquery.dataTables.min',
            'plugins/DataTables-1.13.8/Responsive-2.5.0/js/dataTables.responsive.min',

            // Sweetalert2
            'plugins/sweetalert2/sweetalert2.all',
            
            // Toast
            'plugins/toastr/toastr.min',
        );

        $resource->addCss($css);
        $resource->addJs($js);

        $data['css'] = $resource->getCss();
        $data['js'] = $resource->getJs();

        $data['header'] = view('layout/header', $data);
        $data['footer'] = view('layout/footer', $data);

        // consulta al servicio web
        $servicio = new Webservices();
        $wsdl = $servicio->getWS();
        $options = $servicio->getOptions();
        $soap = new \SoapClient($wsdl, $options);
        
        // $param = array(
        //     'post' => 0, // 0 consulta todos, 1 consulta por codigo
        //     'codigo' => '', // vacio -> 0, con codigo -> 1 (se tiene que enviar codigo: P00001)
        // );

        // // Para obtener los datos
        // $result_perfiles = $soap->Perfiles_listar($param);
        // $data_perfiles = json_decode($result_perfiles->Perfiles_listarResult,true);
        // $ls_perfiles = $data_perfiles['Resultado'];
        
        // $head = "";
        // $cb = array("# Código", "Nombre", "Estado", "#", "#", "#");
        // $head.="<tr>";
        // foreach ($cb as $c) {
        //     $head.="<th class='text-center'>". $c ."</th>";
        // }
        // $head.="</tr>";

        // $body = "";
        // foreach ($ls_perfiles as $dt) {
        //     $body.="<tr>";
        //     $body.="
        //         <td class='text-center'>". $dt['i_id'] ."</td>
        //         <td class='text-left'>". $dt['v_perfil'] ."</td>
        //         <td class='text-center'><span class='badge bg-". $dt['v_color'] ."'>". $dt['v_estado'] ."</span></td>
        //         <td class='text-center'>
        //             <a id=". $dt['i_id'] ." class='btn btn-warning btn-sm editar'>
        //                 <i class='fas fa-edit'></i>
        //             </a>
        //         </td>
        //         <td class='text-center'>
        //             <a href='". base_url("/accesos") . "?codigo=". $dt['i_id'] ." ' class='btn btn-primary btn-sm'>
        //                 <i class='fa fa-cog'></i>
        //             </a>
        //         </td>
        //         <td class='text-center'>
        //             <a id=". $dt['i_id'] ."_". $dt['v_perfil'] ." class='btn btn-danger btn-sm eliminar'>
        //                 <i class='fas fa-trash-alt'></i>
        //             </a>
        //         </td>
        //     ";
        //     $body.="</tr>";
        // }

        $result = $soap->Lista();
        $data_perfiles = json_decode($result->ListaResult,true);

        $head = "";
        $body = "";
        if (!empty($data_perfiles)) {
            $header = array_keys($data_perfiles[0]);
        
            $head.= "<tr>";
            foreach ($header as $columnName) {
                $head.= "<th class='text-center'>" . $columnName . "</th>";
            }
            $head.= "</tr>";
        
            foreach ($data_perfiles as $item) {
                $body.= "<tr>";
                foreach ($item as $value) {
                    $body.= $value;
                }
                $body.= "</tr>";
            }
        } else {
            echo 'No hay datos para mostrar.';
        };
        
        $data['headperfiles'] = $head;
        $data['bodyperfiles'] = $body;

        return view('configuracion/perfiles', $data);
    }

    public function conusuarios(): string
    {
        $resource = new Resource();

        $menu = new Menu();
        $menu->postMenu(session('list_menu'), "configuracion", "conusuarios");

        $data['pageTitle'] = 'Usuarios';
        
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

        return view('configuracion/usuarios', $data);
    }

    public function getperfil()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            $post = $this->request->getGet('post');
            $codigo = $this->request->getGet('codigo');

            // consulta al servicio web
            $servicio = new Webservices();
            $wsdl = $servicio->getWS();
            $options = $servicio->getOptions();

            $params = array(
				'post' => $post,
                'codigo' => $codigo,
			);

            $soap = new \SoapClient($wsdl, $options);
            
            $_result = $soap->Perfiles_listar($params);
            $_response = json_decode($_result->Perfiles_listarResult,true);

            $data = $_response['Resultado'][0];

        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }

        // Responde con un mensaje
        return $this->response->setJSON($data);
    }

    public function mantperfil()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            $datos = $this->request->getJSON();

            $post = $datos->post;
            $codigo = $datos->codigo;
            $nombre = $datos->nombre;
            $estado = $datos->estado;
            $usuario = $user['v_dni'];

            // consulta al servicio web
            $servicio = new Webservices();
            $wsdl = $servicio->getWS();
            $options = $servicio->getOptions();

            $params = array(
				'post' => $post,
				'codigo' => $codigo,
                'nombre' => $nombre,
                'estado' => $estado,
                'usuario' => $usuario,
			);

            $soap = new \SoapClient($wsdl, $options);
            
            $_result = $soap->Perfil_mant($params);
            $_response = json_decode($_result->Perfil_mantResult,true);

            $data = $_response['Resultado'][0];

        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }

        // Responde con un mensaje
        return $this->response->setJSON($data);
    }

    public function accesos(): string
    {
        // Obtener parámetros de la cadena de consulta
        $perfil = $this->request->getGet('codigo');

        $resource = new Resource();

        $menu = new Menu();
        $menu->postMenu(session('list_menu'), "configuracion", "conperfiles");

        $data['pageTitle'] = 'Administración de Perfiles';
        
        $css = array(
            'plugins/fontawesome-free/css/all.min',
            'dist/css/adminlte.min',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min',
            'dist/css/myStyle',
            
            // DataTables
            // 'plugins/datatables-bs4/css/dataTables.bootstrap4.min',
            // 'plugins/datatables-responsive/css/responsive.bootstrap4',
            // 'plugins/datatables-responsive/css/responsive.bootstrap4.min',
            // 'plugins/datatables-buttons/css/buttons.bootstrap4.min',

            // DataTables 1.13.8
            'plugins/DataTables-1.13.8/css/jquery.dataTables.min',
            'plugins/DataTables-1.13.8/Responsive-2.5.0/css/responsive.dataTables.min',
            
            // Sweetalert2
            'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min',
            
            // Toast
            'plugins/toastr/toastr.min',
        );
        
        $js = array(
            // 'plugins/jquery/jquery.min',
            'plugins/jquery/jquery-3.7.0.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/bootstrap/js/bootstrap.bundle.min',
            'plugins/fontawesome-free/js/all.min',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
            'dist/js/adminlte',
            'plugins/js/globales',
            'plugins/js/perfiles/accesos',

            // DataTables
            // 'plugins/datatables/jquery.dataTables.min',
            // 'plugins/datatables-bs4/js/dataTables.bootstrap4.min',
            // 'plugins/datatables-responsive/js/dataTables.responsive.min',
            // 'plugins/datatables-responsive/js/responsive.bootstrap4.min',
            // 'plugins/datatables-buttons/js/dataTables.buttons.min',
            // 'plugins/datatables-buttons/js/buttons.bootstrap4.min',

            // DataTables 1.13.8
            'plugins/DataTables-1.13.8/js/jquery.dataTables.min',
            'plugins/DataTables-1.13.8/Responsive-2.5.0/js/dataTables.responsive.min',

            // Sweetalert2
            'plugins/sweetalert2/sweetalert2.all',
            
            // Toast
            'plugins/toastr/toastr.min',
        );

        $resource->addCss($css);
        $resource->addJs($js);

        $data['css'] = $resource->getCss();
        $data['js'] = $resource->getJs();

        $data['header'] = view('layout/header', $data);
        $data['footer'] = view('layout/footer', $data);

        // consulta al servicio web
        $servicio = new Webservices();
        $wsdl = $servicio->getWS();
        $options = $servicio->getOptions();
        $soap = new \SoapClient($wsdl, $options);
        
        $param1 = array(
            "post" => 1, // 0 -> Lista de menu login, 1 -> Listado de menu por perfil
            "perfil"=> $perfil,
        );

        // Para obtener datos del menu x perfil
        $_Menu_Perfil = $soap->Menu_Perfil($param1);
        $data_menu = json_decode($_Menu_Perfil->Menu_PerfilResult,true);
        $ls_menu = $data_menu['Resultado'];
        
        $body_menu = "";
        foreach ($ls_menu as $m) {
            $body_menu.="<tr>";
            $body_menu.="
                <td class='text-center'>". $m['i_id'] ."</td>
                <td class='text-center'>". $m['i_orden'] ."</td>
                <td class='text-left'>". $m['v_menu'] ."</td>
                <td class='text-center'><span class='badge bg-". $m['v_color'] ."'>". $m['v_estado'] ."</span></td>
                <td class='text-center'>
                    <a id=". $m['i_id'] ."_". $m['v_menu'] ." class='btn btn-danger btn-sm eliminar'>
                        <i class='fas fa-trash-alt'></i>
                    </a>
                </td>
            ";
            $body_menu.="</tr>";
        }

        $param2 = array(
            "post" => 1, // 0 -> Lista de submenu login, 1 -> Listado de submenu por perfil
            "perfil"=> $perfil,
            "menu"=> "",
        );

        // Para obtener datos del submenu x perfil
        $_SubMenu_Perfil = $soap->SubMenu_Perfil($param1);
        $data_submenu = json_decode($_SubMenu_Perfil->SubMenu_PerfilResult,true);
        $ls_submenu = $data_submenu['Resultado'];
        
        $body_submenu = "";
        foreach ($ls_submenu as $sm) {
            $body_submenu.="<tr>";
            $body_submenu.="
                <td class='text-center'>". $sm['v_padre'] ."</td>
                <td class='text-center'>". $sm['i_id'] ."</td>
                <td class='text-center'>". $sm['i_orden'] ."</td>
                <td class='text-left'>". $sm['v_submenu'] ."</td>
                <td class='text-center'><span class='badge bg-". $sm['v_color'] ."'>". $sm['v_estado'] ."</span></td>
                <td class='text-center'>
                    <a id=". $sm['i_id'] ."_". $sm['v_menu'] ." class='btn btn-danger btn-sm eliminar'>
                        <i class='fas fa-trash-alt'></i>
                    </a>
                </td>
            ";
            $body_submenu.="</tr>";
        }

        $data['bodymenu'] = $body_menu;
        $data['bodysubmenu'] = $body_submenu;

        return view('configuracion/accesos', $data);
    }
}