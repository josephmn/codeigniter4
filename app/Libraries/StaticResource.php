<?php

namespace App\Libraries;

class StaticResource
{
    protected $css = [];
    protected $js = [];

    public $_css;
    public $_js;

    public function addCss(array $css)
    {
        if (is_array($css) && count($css)) {
			for ($i = 0; $i < count($css); $i++) {
				$this->_css[] = base_url('public/' . $css[$i] . '.css');
			}
		} else {
			$this->_css[] = "";
		}
        // $this->css[] = $css;
    }

    public function addJs(array $js)
    {
        if (is_array($js) && count($js)) {
			for ($i = 0; $i < count($js); $i++) {
				$this->_js[] = base_url('public/' . $js[$i] . '.js');
			}
		} else {
			$this->_js[] = "";
		}
        // $this->js[] = $file;
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