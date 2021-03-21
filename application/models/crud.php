<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Model {

	public $title;
    public $content;
    public $date;


	public function inserir($tabela,$sql)
		{
			error_reporting(0);
			$this->load->database();
			$ins = $this->db->insert($tabela,$sql);
			return $ins;
		}

	public function update($table,$data,$campocondicional,$condicao)
		{
			error_reporting(0);
			$this->load->database();
			$this->db->where($campocondicional, $condicao);
			$ins = $this->db->update($table, $data);
			return $ins;
		}

	public function delete($tabela, $coluna, $id)
		{
			error_reporting(0);
			$this->load->database();
			$this->db->where($coluna, $id);
			$ins = $this->db->delete($tabela);
			return $ins;
		}
}