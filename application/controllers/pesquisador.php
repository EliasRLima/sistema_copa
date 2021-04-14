<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesquisador extends CI_Controller {


	public function index()
	{
		$this->load->helper('url');
		$this->load->library('session');
		
		if($this->session->has_userdata('LOGIN')){
			if($this->session->has_userdata('GRUPO')){
				$grupo = $this->session->userdata('GRUPO');
				if($grupo == 1){
					//pode ver essa tela
				}else if($grupo == 2){
					echo '<script type="text/javascript">window.location.replace("nit");</script>';
				}else if($grupo == 3){
					echo '<script type="text/javascript">window.location.replace("inpi");</script>';
				}else if($grupo == 4){
					//nao faz nada, ADM PODE VER ESSA TELA LOGADO!
				}else{
					$this->session->unset_userdata('LOGIN');
					$this->session->unset_userdata('GRUPO');
					echo '<script type="text/javascript">window.location.replace("acesso/LOGIN");</script>'; 
				}
			}else{
				$this->session->unset_userdata('LOGIN');
                echo '<script type="text/javascript">window.location.replace("acesso/LOGIN");</script>'; 
			}
			
		}else{
            echo '<script type="text/javascript">window.location.replace("acesso/LOGIN");</script>'; 
        }

		$user = $this->session->userdata('LOGIN');
		$data['identificador'] = $user['identificador'];
		$data['area'] = $this->input->get('area');
		$this->load->model('md_patente');

		if($data['area'] == 1){//se for para cadastrar nova, deve carregar os tipos do banco
			$data_aux = $this->md_patente->getTipos();
			$data['tipos'] = $data_aux['tipo'];
			
		}else if($data['area'] == 2){//carregar patentes que precisam de reajuste
			$data_aux = $this->md_patente->getPatentesAjustes($user['cpfcnpj']);
			$data['ajustes'] = $data_aux['ajuste'];
			$data_aux = $this->md_patente->getTipos();
			$data['tipos'] = $data_aux['tipo'];
			$id = $this->input->get('patente');
			$patente = $this->session->flashdata('patente');
			$patente = array(
                'ajuste' => 'precisa mudar a descricao, colocar de forma mais clara.',
                'dtajuste' => '21/03/2021',
                'patente' => 'Jogo de cartas',
                'situacao' => 'Pendente',
                'descricao' => 'Eh um jogo bom',
            );
			$data['patente'] = $patente;
			if(isset($id)){
				$data['patente_ajuste'] = $id;
				
			}else{
				$data['patente_ajuste'] = -1;
			}
		}
		$data['aviso'] = '1';
		$this->load->view('pesquisador', $data);
		$this->session->set_userdata('FOOTER', '<center><h4 class="txt">&reg;COPA - 2021</h4></center>');
		$this->load->view('footer');
	}
}