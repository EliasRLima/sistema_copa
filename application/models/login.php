<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Model {

	public $title;
    public $content;
    public $date;


    public function verificar($pessoa,$senha)
		{
			error_reporting(0);
			$this->load->database();
            $senha = sha1($senha);
            $sql = "SELECT u.cpfcnpj, CONCAT( u.nome, ' ', u.sobrenome ) as identificador, u.nome, u.idgrupo, u.idUsuario as idusuario FROM usuario u, senhas s WHERE u.status <> 2 and u.cpfcnpj = '".$pessoa."' and s.idUsuario = u.idUsuario and s.status = 1 and s.senha = '".$senha."'";
			$query = $this->db->query($sql);
            foreach ($query->result() as $row){
                $user = array(
                    'identificador' => $row->nome,
                    'cpfcnpj' => $row->cpfcnpj,
                    'grupo' => $row->idgrupo,
                    'idusuario' => $row->idusuario
                );
                $this->session->set_userdata('LOGIN', $user);
				return 1;
			}
			return 0;	
		}

}