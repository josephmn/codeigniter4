<?php

namespace App\Libraries;

class Resource
{
    public $css = [];
    public $js = [];

    protected $_css;
    protected $_js;

    public function addCss(array $_css)
    {
        if (is_array($_css) && count($_css)) {
			for ($i = 0; $i < count($_css); $i++) {
				$this->css[] = base_url(). $_css[$i] . '.css';
			}
		} else {
			$this->css[] = "";
		}
    }

    public function addJs(array $_js)
    {
        if (is_array($_js) && count($_js)) {
			for ($i = 0; $i < count($_js); $i++) {
				$this->js[] = base_url(). $_js[$i] . '.js?v=' . $_SERVER['LAST_VERSION_SOURCE'];
			}
		} else {
			$this->js[] = "";
		}
    }

    public function resource_default()
    {
        $css = array(
            'plugins/fontawesome-free/css/all.min',
            'dist/css/adminlte.min',
            'plugins/overlayScrollbars/css/OverlayScrollbars.min',
            'dist/css/inicio',
        );

        $js = array(
            'plugins/fontawesome-free/js/all.min',
            'plugins/jquery/jquery.min',
            'plugins/jquery-ui/jquery-ui.min',
            'plugins/bootstrap/js/bootstrap.bundle.min',
            'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min',
            'dist/js/adminlte',
        );

        $this->addCss($css);
        $this->addJs($js);

        $data['css'] = $this->getCss($css);
        $data['js'] = $this->getJs($js);

        return $data;
    }

    public function getCss()
    {
        return $this->css;
    }

    public function getJs()
    {
        return $this->js;
    }
}

?>