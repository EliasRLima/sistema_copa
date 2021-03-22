<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patente extends CI_Controller {


	public function index()
	{
        error_reporting(0);
        $this->load->library('session');
		
	}

	public function cadastro(){
		//dps voltar para pesquisador?area=1
		$this->load->helper('url');
		$this->load->library('session');
		$patente = array(
			'nome' => $this->input->post('patente_name'),
			'descricao' => $this->input->post('patente_descricao'),
			'tipo' => $this->input->post('patente_tipo')
		);

		$user = $this->session->userdata('LOGIN');
		$this->load->model('crud');
        $sql = array(
			'nome' => $patente['nome'], 
			'idtipo' => $patente['tipo'], 
			'situacao' => 1, 
			'descricao' => $patente['descricao']
            );

        $tabela = 'patente';
        $valor = $this->crud->Inserir($tabela,$sql);
		//$valor = 1;
        if($valor > 0){
			$this->load->model('md_patente');
			$idpatente = $this->md_patente->getIdPatente($patente['nome']);
			$sql = array(
				'idpatente' => $idpatente, 
				'idusuario' => $user['idusuario'], 
				'dtini' => str_replace('/','',date('Y/m/d'))
			);
			$tabela = 'patenteproprietario';
			$valor = $this->crud->Inserir($tabela,$sql);
			if($valor > 0){
				//true
				$sql = array(
					'idpatente' => $idpatente,
					'idgruporecebimento' => 2,
					'dtsolicitacao' => str_replace('/','',date('Y/m/d')),
					'status' => 1
				);
				$tabela = 'patentesolicitacao';
				$valor = $this->crud->Inserir($tabela,$sql);
				$this->session->set_userdata('key_fail', 'sucess');
                echo '<script type="text/javascript">window.location.replace("../pesquisador?area=1");</script>';
			}else{
				//false
				$tabela = 'patente';
                $coluna = 'idpatente';
                $valor = $this->crud->delete($tabela, $coluna, $idpatente);
                $this->session->set_userdata('key_fail', 'fail');
                echo '<script type="text/javascript">window.location.replace("../pesquisador?area=1");</script>';
			}
		}else{
			//falhou
			$this->session->set_userdata('key_fail', 'fail');
            echo '<script type="text/javascript">window.location.replace("../pesquisador?area=1");</script>';
		}

	}

	public function ajuste(){
		//dps voltar para pesquisador?area=2
		$this->load->helper('url');
		$this->load->library('session');
		$patente = array(
			'idajuste' => $this->input->post('idpatenteajuste'),
			'nome' => $this->input->post('patente_name'),
			'descricao' => $this->input->post('idpatenteajuste'),
			'tipo' => $this->input->post('patente_descricao')
		);
		$this->load->model('md_patente');
		$ajuste = $this->md_patente->enviarAjuste($patente);
	}

	public function selecionar(){
		$this->load->helper('url');
		$this->load->library('session');

		$idpatenteajuste = $this->input->post('idajuste');
		$this->load->model('md_patente');
		$data = $this->md_patente->getPatentePorAjuste($idpatenteajuste);
		$this->session->set_flashdata('patente',$data);
		echo '<script type="text/javascript">window.location.replace("../pesquisador?area=2&patente='.$idpatenteajuste.'");</script>'; 
	}
}