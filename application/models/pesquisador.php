<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesquisador extends CI_Model {

	public $title;
    public $content;
    public $date;

    public function existeCpf($cpf)
        {
            error_reporting(0);
			$this->load->database();
            $sql = "SELECT u.cpfcnpj FROM usuario u WHERE u.cpfcnpj = '".$cpf."'";
			$query = $this->db->query($sql);
            foreach ($query->result() as $row){
				return 1;
			}
			return 0;	
        }

    public function getIdUser($cpf)
        {
            error_reporting(0);
			$this->load->database();
            $sql = "SELECT u.idusuario FROM usuario u WHERE u.cpfcnpj = '".$cpf."'";
			$query = $this->db->query($sql);
            foreach ($query->result() as $row){
				return $row->idusuario;
			}
			return -1;	
        }

}