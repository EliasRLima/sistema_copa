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
            $sql = "SELECT u.cpfcnpj, CONCAT( u.nome, ' ', u.sobrenome ) as identificador, u.idgrupo FROM usuario u, senhas s WHERE u.status <> 2 and u.cpfcnpj = '".$pessoa."' and s.idUsuario = u.idUsuario and s.status = 1 and s.senha = '".$senha."'";
			$query = $this->db->query($sql);
            foreach ($query->result() as $row){
                $this->session->set_userdata('LOGIN', $row->identificador);
                if($row->idgrupo == 4){
                    $_SESSION['ADM'] = $row->cpfcnpj;
                }
				return 1;
			}
			return 0;	
		}

}