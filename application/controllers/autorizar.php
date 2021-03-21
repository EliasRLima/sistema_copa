<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autorizar extends CI_Controller {


	public function index()
	{
        error_reporting(0);
        $this->load->library('session');
		$pessoa = $this->input->post('usercopa');
        $pessoa = str_replace("-","",str_replace(".","",str_replace("/","",$pessoa)));
		$senha = $this->input->post('pass');
        $this->load->model('login');
        $login = $this->login->verificar($pessoa,$senha);
        if($login == 1){
        	echo '<script type="text/javascript">window.location.replace("menu");</script>';
        }
        else{
            $this->session->set_userdata('key_fail', 'login');
        	echo '<script type="text/javascript">window.location.replace("login");</script>';
        }
		
	}
}