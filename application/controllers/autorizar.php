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
            $grupo = $this->login->getGrupo($pessoa);
            $this->session->set_userdata('GRUPO', $grupo);
            if($grupo == 1){
                echo '<script type="text/javascript">window.location.replace("patente");</script>';
            }else if($grupo == 2){
                echo '<script type="text/javascript">window.location.replace("nit");</script>';
            }else if($grupo == 3){
                echo '<script type="text/javascript">window.location.replace("inpi");</script>';
            }else if($grupo == 4){
                echo '<script type="text/javascript">window.location.replace("adm");</script>';
            }
        	echo '<script type="text/javascript">window.location.replace("logoff");</script>';
        }
        else{
            $this->session->set_userdata('key_fail', 'login');
        	echo '<script type="text/javascript">window.location.replace("login");</script>';
        }
		
	}
}