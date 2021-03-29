<?php
/**
 * Created by PhpStorm.
 * User: Abnet
 * Date: 10/26/2019
 * Time: 8:52 AM
 */

namespace Absoft\Line\Modeling;

abstract class Controller{

    public $_main_address;
    public $files;
    public $headers;
    public $request;
    public $_app_url;

    public function __construct($headers, $request, $_main_address, $_app_url, $files){

        $this->files = $files;
        $this->headers = $headers;
        $this->request = $request;
        $this->_main_address = $_main_address;
        $this->_app_url = $_app_url;

    }

    abstract public function route($name, $parameter);

}
