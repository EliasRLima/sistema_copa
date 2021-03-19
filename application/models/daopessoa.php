<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DaoPessoa extends CI_Model {

	public $title;
    public $content;
    public $date;


    public function getPessoas() // nao pega ADMS
		{
			error_reporting(0);
			$this->load->database();
			$sql = "SELECT `idPessoa` as idpessoa, `Nome` as nome, `cpfcnpj` as cpfcnpj, `dtNascimento` as dtn  FROM `pessoa` WHERE `idPessoa` not in (select a.idPessoa from acessos a where a.acesso = 2) and `deletado` is null order by ASC";
			$query = $this->db->query($sql);
			$aluno['aluno'] = '';
			foreach ($query->result() as $row){
				$aluno['aluno'] .= '"<option value="'.$row->idpessoa.'">'.$row->nome.' / '.$row->cpfcnpj.'</option>";';
			}
			return $aluno;		
				
		}

	public function getPessoa($cpfcnpj)
		{
			error_reporting(0);
			$this->load->database();
			$sql = "SELECT `idPessoa` as idpessoa, `Nome` as nome, `cpfcnpj` as cpfcnpj, `dtNascimento` as dtn  FROM `pessoa` WHERE `idPessoa` not in (select a.idPessoa from acessos a where a.acesso = 2) and `deletado` is null and `cpfcnpj` = '".$cpfcnpj."'order by ASC";
			$query = $this->db->query($sql);
			$aluno['aluno'] = '';
			foreach ($query->result() as $row){
				$aluno['cpfcnpj'] = $row->cpfcnpj;
				$aluno['nome'] = $row->nome;
				$aluno['dtn'] = $row->dtn;
				$aluno['idpessoa'] = $row->idpessoa;
			}
			return $aluno;		
				
		}
			
		
}