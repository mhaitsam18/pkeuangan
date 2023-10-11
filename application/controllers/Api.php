<?php
class Api extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        header("Content-Type:application/json");
        header('Access-Control-Allow-Origin: *'); 
    }

}

