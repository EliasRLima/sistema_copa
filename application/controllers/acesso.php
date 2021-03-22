<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acesso extends CI_Controller {


	public function Login()
	{
		$this->load->library('session');
        if(!$this->session->has_userdata('key_fail')){
            $this->session->set_userdata('key_fail', '');
        }
		$this->load->helper('url');
        $data['login'] = 'true';
        $this->load->view('topo', $data);
		$this->load->view('login');
        $this->session->set_userdata('FOOTER', '<center><h4 class="txt">&reg;COPA - 2021</h4></center>');
		$this->load->view('footer');

	}

    public function Logoff()
	{
        error_reporting(0);
        $this->load->library('session');
		$this->session->unset_userdata('LOGIN');
        $this->session->unset_userdata('GRUPO');
        echo '<script type="text/javascript">window.location.replace("login");</script>';
		
	}

    public function Autorizar()
	{
        error_reporting(0);
        $this->load->library('session');
		$pessoa = $this->input->post('usercopa');
        $pessoa = str_replace("-","",str_replace(".","",str_replace("/","",$pessoa)));
		$senha = $this->input->post('pass');
        $this->load->model('login');
        $login = $this->login->verificar($pessoa,$senha);
        if($login == 1){
            $user = $this->session->userdata('LOGIN');
            $this->session->set_userdata('GRUPO', $user['grupo']);
            if($user['grupo'] == 1){
                echo '<script type="text/javascript">window.location.replace("../pesquisador");</script>';
            }else if($user['grupo'] == 2){
                echo '<script type="text/javascript">window.location.replace("../nit");</script>';
            }else if($user['grupo'] == 3){
                echo '<script type="text/javascript">window.location.replace("../inpi");</script>';
            }else if($user['grupo'] == 4){
                echo '<script type="text/javascript">window.location.replace("../adm");</script>';
            }
        	echo '<script type="text/javascript">window.location.replace("logoff");</script>';
        }
        else{
            $this->session->set_userdata('key_fail', 'login');
        	echo '<script type="text/javascript">window.location.replace("login");</script>';
        }
		
	}
}


