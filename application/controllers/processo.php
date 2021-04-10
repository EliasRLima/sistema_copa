<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Processo extends CI_Controller {


	public function recusar()
	{
		$this->load->library('session');
        $this->load->helper('url');

        if($this->session->has_userdata('LOGIN')){
			if($this->session->has_userdata('GRUPO')){
				$grupo = $this->session->userdata('GRUPO');
				if($grupo == 1){
					echo '<script type="text/javascript">window.location.replace("../pesquisador");</script>';
				}else if($grupo == 2){
                    //pode ver essa tela
				}else if($grupo == 3){
					echo '<script type="text/javascript">window.location.replace("../inpi");</script>';
				}else if($grupo == 4){
					//nao faz nada, ADM PODE VER ESSA TELA LOGADO!
				}else{
					$this->session->unset_userdata('LOGIN');
					$this->session->unset_userdata('GRUPO');
				}
			}else{
				$this->session->unset_userdata('LOGIN');
                echo '<script type="text/javascript">window.location.replace("../acesso/LOGIN");</script>'; 
			}
			
		}else{
            echo '<script type="text/javascript">window.location.replace("../acesso/LOGIN");</script>'; 
        }
        
        $condicao = $this->input->get('id');
		$this->load->model('md_patente');
		$solicitacao = $this->md_patente->getSolicitacaoAll($condicao);

		$this->load->model('crud');
        $campos = array(
			'status' => 2
            );
        $tabela = 'patentesolicitacao';
		$campocondicional = 'idsolicitacao';
        $valor = $this->crud->update($tabela,$campos,$campocondicional,$condicao);
		
		$campos = array(
			'situacao' => 4
            );
        $tabela = 'patente';
		$campocondicional = 'idpatente';
        $valor = $this->crud->update($tabela,$campos,$campocondicional, $solicitacao['idpatente']);
		
		$status = 'rep';
		$this->session->set_flashdata('status',$status);
		echo '<script type="text/javascript">window.location.replace("../nit");</script>';
	}

	public function Aprovar()
	{
		$this->load->library('session');
        $this->load->helper('url');

        if($this->session->has_userdata('LOGIN')){
			if($this->session->has_userdata('GRUPO')){
				$grupo = $this->session->userdata('GRUPO');
				if($grupo == 1){
					echo '<script type="text/javascript">window.location.replace("../pesquisador");</script>';
				}else if($grupo == 2){
                    //pode ver essa tela
				}else if($grupo == 3){
					echo '<script type="text/javascript">window.location.replace("../inpi");</script>';
				}else if($grupo == 4){
					//nao faz nada, ADM PODE VER ESSA TELA LOGADO!
				}else{
					$this->session->unset_userdata('LOGIN');
					$this->session->unset_userdata('GRUPO');
				}
			}else{
				$this->session->unset_userdata('LOGIN');
                echo '<script type="text/javascript">window.location.replace("../acesso/LOGIN");</script>'; 
			}
			
		}else{
            echo '<script type="text/javascript">window.location.replace("../acesso/LOGIN");</script>'; 
        }
        
        $condicao = $this->input->post('idsolicitacao');
		$this->load->model('md_patente');
		$solicitacao = $this->md_patente->getSolicitacaoAll($condicao);

		$this->load->model('crud');
        $campos = array(
			'status' => 4
            );
        $tabela = 'patentesolicitacao';
		$campocondicional = 'idsolicitacao';
        $valor = $this->crud->update($tabela,$campos,$campocondicional,$condicao);
		
		$campos = array(
			'situacao' => 1
            );
        $tabela = 'patente';
		$campocondicional = 'idpatente';
        $valor = $this->crud->update($tabela,$campos,$campocondicional, $solicitacao['idpatente']);
		
		$status = 'apv';
		$this->session->set_flashdata('status',$status);
		echo '<script type="text/javascript">window.location.replace("../nit");</script>';
	}
}