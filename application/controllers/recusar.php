<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recusar extends CI_Controller {


	public function index()
	{
		$this->load->library('session');
        $this->load->helper('url');

        if($this->session->has_userdata('LOGIN')){
			if($this->session->has_userdata('GRUPO')){
				$grupo = $this->session->userdata('GRUPO');
				if($grupo == 1){
					echo '<script type="text/javascript">window.location.replace("pesquisador");</script>';
				}else if($grupo == 2){
                    //pode ver essa tela
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
                echo '<script type="text/javascript">window.location.replace("acesso/LOGIN");</script>'; 
			}
			
		}else{
            echo '<script type="text/javascript">window.location.replace("acesso/LOGIN");</script>'; 
        }
        
        $idsolicitacao = $this->input->post('idsolicitacao');

	}
}