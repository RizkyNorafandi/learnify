<?php
defined('BASEPATH') or exit('No direct script access allowed');


use chriskacerguis\RestServer\RestController;

class Admins extends RestController
{


    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
    }


    public function index() {}


    public function login_post() {}

    
}

/* End of file Auth_admin.php */
