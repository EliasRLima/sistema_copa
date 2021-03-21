<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {


	public function index()
	{
		$this->load->helper('url');
		$this->load->library('session');
		if($this->session->has_userdata('LOGIN')){
			if($this->session->has_userdata('GRUPO')){
				$grupo = $this->session->userdata('GRUPO');
				if($grupo == 1){
					echo '<script type="text/javascript">window.location.replace("patente");</script>';
				}else if($grupo == 2){
					echo '<script type="text/javascript">window.location.replace("nit");</script>';
				}else if($grupo == 3){
					echo '<script type="text/javascript">window.location.replace("inpi");</script>';
				}else if($grupo == 4){
					//nao faz nada, ADM PODE VER ESSA TELA LOGADO!
				}else{
					$this->session->unset_userdata('LOGIN');
					$this->session->unset_userdata('GRUPO');
				}
			}else{
				$this->session->unset_userdata('LOGIN');
			}
			
		}
		$this->load->view('topo');
		$this->load->view('menu_inicial');
		$this->session->set_userdata('FOOTER', '<center><h4 class="txt">&reg;COPA - 2021</h4></center>');
		$this->load->view('footer');
	}
}