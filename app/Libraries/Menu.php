<?php

namespace App\Libraries;

class Menu
{
    protected $_menu;
    protected $_submenu;
    protected $_flechita;
    protected $_active;
    protected $_active_m;
    protected $_active_sm;
    protected $_row;

    public function postMenu(array $ls_menu, $menu = "", $submenu = "")
    {
        $_menu = "";
        $_submenu = "";
        $_flechita = "";
        $_active_m = "";
        $_active_sm = "";
        $_style_icon = "";
        $_mopen = "";

        foreach ($ls_menu as $m) {
            $_active_sm = "";
            $_submenu = "";
            $_style_icon = "";
            $_mopen = "";

            // <span class='right badge badge-danger'>New</span>
            if (count($m['mSubMenu']) > 0) {
                $_flechita = "<i class='right fas fa-angle-left'></i>";
                $_submenu.= "<ul class='nav nav-treeview'>";
                $sub = $m['mSubMenu'];
                foreach ($sub as $sm) {
                    $_active_sm = $sm['v_link'] == $submenu ? " active" : "";
                    $_submenu.="
                        <li class='nav-item'>
                            <a href='". $sm['v_link'] ."' class='nav-link". $_active_sm ."'>
                                <i class='". $sm['v_icon'] ." nav-icon'></i>
                                <p>". $sm['v_submenu'] ."</p>
                            </a>
                        </li>";
                }
                $_submenu.= "</ul>";
            }
            
            $_active_m = ($m['v_link'] == $menu) ? " active" : "";
            $_style_icon = ($m['v_link'] == $menu) ? "style='". $m['v_style'] ."'" : "";
            $_animate_icon = ($m['v_link'] == $menu) ? " ". $m['v_animate'] : "";
            $_mopen = ($m['v_link'] == $menu) ? " menu-is-opening menu-open" : "";

            $_menu .= "
            <li class='nav-item". $_mopen ."'>
                <a href='". $m['v_link'] ."' class='nav-link". $_active_m ."'>
                    <i class='nav-icon ". $m['v_icon'] . $_animate_icon ."'". $_style_icon ."></i>
                    <p> ". $m['v_menu'] ." ". $_flechita ."</p>
                </a>
                ". $_submenu ."
            </li>";
        }
		
        $session = session();
        $session->set('menu', $_menu);
    }
}

?>