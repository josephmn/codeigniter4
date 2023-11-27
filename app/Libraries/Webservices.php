<?php

namespace App\Libraries;

class Webservices
{
    public $ws = "http://localhost:60714/wsNetprodex.asmx?WSDL";
    
    public $options = array(
        "style"=> SOAP_RPC,
        "use"=> SOAP_ENCODED,
        "soap_version"=> SOAP_1_1,
        "connection_timeout"=> 120,
        "trace"=> false,
        "encoding"=> "UTF-8",
        "exceptions"=> false,
    );

    public function getWS()
    {
        return $this->ws;
    }

    public function getOptions()
    {
        return $this->options;
    }
}

?>