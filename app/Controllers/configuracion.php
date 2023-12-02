<?php

namespace App\Controllers;
use App\Libraries\Resource;
use App\Libraries\Webservices;
use App\Libraries\Menu;
use CodeIgniter\I18n\Time;

class configuracion extends BaseController
{
    public function conperfiles()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            $resource = new Resource();

            $menu = new Menu();
            $menu->postMenu(session('list_menu'), "configuracion", "conperfiles");

            $data['pageTitle'] = "<h1 class'm-0'>Perfiles</h1>";
            
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
                'plugins/js/configuracion/perfiles',

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
            
            $param = array(
                'post' => 0, // 0 consulta todos, 1 consulta por codigo
                'codigo' => '', // vacio -> 0, con codigo -> 1 (se tiene que enviar codigo: P00001)
            );

            // Para obtener los datos
            $result_perfiles = $soap->Perfiles_listar($param);
            $data_perfiles = json_decode($result_perfiles->Perfiles_listarResult,true);
            $ls_perfiles = $data_perfiles['Resultado'];
            
            $head = "";
            $cb = array("# Código", "Nombre", "Estado", "Fecha Registro", ".#", "..#", "...#");
            $head.="<tr>";
            foreach ($cb as $c) {
                $head.="<th class='text-center'>". $c ."</th>";
            }
            $head.="</tr>";

            $body = "";
            foreach ($ls_perfiles as $dt) {

                $fechasql = $dt['d_crtd_date'];
                $fechaOrig = Time::createFromFormat('Y-m-d\TH:i:s.u', $fechasql);
                $nuevoFormato = $fechaOrig->format('d-m-Y H:i:s');

                $body.="<tr>";
                $body.="
                    <td class='text-center'>". $dt['i_id'] ."</td>
                    <td class='text-left'>". $dt['v_perfil'] ."</td>
                    <td class='text-center'><span class='badge bg-". $dt['v_color'] ."'>". $dt['v_estado'] ."</span></td>
                    <td class='text-center'>". $nuevoFormato ."</td>
                    <td class='text-center'>
                        <a id=". $dt['i_id'] ." class='btn btn-warning btn-sm editar'>
                            <i class='fas fa-edit'></i>
                        </a>
                    </td>
                    <td class='text-center'>
                        <a href='". base_url("/accesos") . "?codigo=". $dt['i_id'] ."&nombre=". $dt['v_perfil'] ." ' class='btn btn-primary btn-sm'>
                            <i class='fa fa-cog'></i>
                        </a>
                    </td>
                    <td class='text-center'>
                        <a id=". $dt['i_id'] ."_". $dt['v_perfil'] ." class='btn btn-danger btn-sm eliminar'>
                            <i class='fas fa-trash-alt'></i>
                        </a>
                    </td>
                ";
                $body.="</tr>";
            }
            
            $data['headperfiles'] = $head;
            $data['bodyperfiles'] = $body;

            return view('configuracion/perfiles', $data);
        } else {
            // $resource = new Resource();
            // $data = $resource->resource_default();

            $session = session();
            $session->destroy();
            // return view('index/login', $data);
            return redirect()->to(base_url('/'));
        }
    }

    public function conusuarios()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            $resource = new Resource();

            $menu = new Menu();
            $menu->postMenu(session('list_menu'), "configuracion", "conusuarios");

            $data['pageTitle'] = "<h1 class'm-0'>Usuarios</h1>";
            
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
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }
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

            // Responde con un mensaje
            return $this->response->setJSON($data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }
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
            
            // Responde con un mensaje
            return $this->response->setJSON($data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }
    }

    public function accesos()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            // Obtener parámetros de la cadena de consulta
            $perfil = $this->request->getGet('codigo');
            $nombre = $this->request->getGet('nombre');

            $resource = new Resource();

            $menu = new Menu();
            $menu->postMenu(session('list_menu'), "configuracion", "conperfiles");

            $data['pageTitle'] = "<h1 class'm-0'>Administración de Perfiles | <b>" . $nombre . "</b> (<b>" . $perfil . "</b>)</h1>";

            $css = array(
                'plugins/fontawesome-free/css/all.min',
                'dist/css/adminlte.min',
                'plugins/overlayScrollbars/css/OverlayScrollbars.min',
                'dist/css/myStyle',
                
                // Select2
                'plugins/select2/css/select2.min',
                'plugins/select2-bootstrap4-theme/select2-bootstrap4.min',

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

                // Select2
                'plugins/select2/js/select2.full.min',
                
                'plugins/fontawesome-free/js/all.min',
                'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
                'dist/js/adminlte',
                'plugins/js/globales',
                'plugins/js/configuracion/accesos',

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
            
            $td = "";
            $body_menu = "";
            foreach ($ls_menu as $m) {
                $body_menu.="<tr>";
                if ($m['i_id'] == 'MEN00001') {
                    $td = "<td class='text-center'></td>";
                } else {
                    $td = "<td class='text-center'>
                        <a id=". $m['i_id'] ."_". $m['v_menu'] ." class='btn btn-danger btn-sm delmenu'>
                            <i class='fas fa-trash-alt'></i>
                        </a>
                    </td>";
                }
                $body_menu.="
                    <td class='text-center'>". $m['i_id'] ."</td>
                    <td class='text-center'>". $m['i_orden'] ."</td>
                    <td class='text-left'>". $m['v_menu'] ."</td>
                    <td class='text-center'><span class='badge bg-". $m['v_color'] ."'>". $m['v_estado'] ."</span></td>
                    ". $td ."
                ";
                $body_menu.="</tr>";
            }

            $param2 = array(
                "post" => 1, // 0 -> Lista de submenu login, 1 -> Listado de submenu por perfil
                "perfil"=> $perfil,
                "menu"=> "",
            );

            // Para obtener datos del submenu x perfil
            $_SubMenu_Perfil = $soap->SubMenu_Perfil($param2);
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
                        <a id=". $sm['i_id'] ."_". $sm['v_menu'] ." class='btn btn-danger btn-sm delsubmenu'>
                            <i class='fas fa-trash-alt'></i>
                        </a>
                    </td>
                ";
                $body_submenu.="</tr>";
            }

            $data['bodymenu'] = $body_menu;
            $data['bodysubmenu'] = $body_submenu;
            $data['perfil'] = $perfil;

            return view('configuracion/accesos', $data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }
    }

    public function getmenu()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            $perfil = $this->request->getGet('perfil');

            // consulta al servicio web
            $servicio = new Webservices();
            $wsdl = $servicio->getWS();
            $options = $servicio->getOptions();

            $param = array(
				'post' => 2, // 2 -> Lista de menu para accesos
                'perfil' => $perfil,
			);

            $soap = new \SoapClient($wsdl, $options);
            
            $_result = $soap->Menu_Perfil($param);
            $_response = json_decode($_result->Menu_PerfilResult,true);
            
            $_registros = $_response['Resultado'];

            $data = "";
            $data.="<option selected='selected' disabled='disabled' value='0'>-- SELECCIONAR --</option>";
            foreach ($_registros as $reg) {
                $data.="<option value='".$reg['i_id']."'>".$reg['v_menu']."</option>";
            }

            $combo = array(
                "data" => $data
            );

            // Responde con un mensaje
            return $this->response->setJSON($combo);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }
    }

    public function getsubmenu()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            $menu = $this->request->getGet('menu');
            $perfil = $this->request->getGet('perfil');

            // consulta al servicio web
            $servicio = new Webservices();
            $wsdl = $servicio->getWS();
            $options = $servicio->getOptions();

            $param = array(
                "post" => 2, // 2 -> Lista de submenu para accesos
                "perfil"=> $perfil,
                "menu"=> $menu,
            );

            $soap = new \SoapClient($wsdl, $options);
            
            $_result = $soap->SubMenu_Perfil($param);
            $_response = json_decode($_result->SubMenu_PerfilResult,true);
            
            $_registros = $_response['Resultado'];

            $data = "";
            $data.="<option selected='selected' disabled='disabled' value='-'>-- SELECCIONAR --</option>";
            foreach ($_registros as $reg) {
                $data.="<option value='".$reg['i_id']."'>".$reg['v_submenu']."</option>";
            }

            $combo = array(
                "data" => $data
            );

            // Responde con un mensaje
            return $this->response->setJSON($combo);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }
    }

    public function mantaccesos()
    {
        $user = session('dt_usuario');
        
        if (isset($user['v_dni'])){
            $datos = $this->request->getJSON();

            $post = $datos->post;
            $perfil = $datos->perfil;
            $menu = $datos->menu;
            $submenu = $datos->submenu;
            $usuario = $user['v_dni'];

            // consulta al servicio web
            $servicio = new Webservices();
            $wsdl = $servicio->getWS();
            $options = $servicio->getOptions();

            $params = array(
				'post' => $post,
				'perfil' => $perfil,
                'menu' => $menu,
                'submenu' => $submenu,
                'usuario' => $usuario,
			);

            $soap = new \SoapClient($wsdl, $options);
            
            $_result = $soap->Mant_accesos($params);
            $_response = json_decode($_result->Mant_accesosResult,true);

            $data = $_response['Resultado'][0];
            /* status code
                100 -> INFORMATIVO
                200 -> EXITO
                400 -> ERROR DE USUARIO
                500 -> ERROR INTERNO
            */
            // Responde con un mensaje
            return $this->response->setJSON($data);
        } else {
            $session = session();
            $session->destroy();
            return redirect()->to(base_url('/'));
        }
    }
}