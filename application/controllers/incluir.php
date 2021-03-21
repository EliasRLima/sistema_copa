<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incluir extends CI_Controller {


	public function index()
	{
        error_reporting(0);
        $this->load->library('session');
		$pessoa = $this->input->post('usercopa');
        $pessoa = str_replace("-","",str_replace(".","",str_replace("/","",$pessoa)));
        $nome = $this->input->post('nome');
        $sobrenome = $this->input->post('sobrenome');
        $email = $this->input->post('email');
		$senha = $this->input->post('pass');
        $senhac = $this->input->post('passconfirm');

        $data = array(
            'cpf'  => $pessoa,
            'email' => $email,
            'nome' => $nome,
            'sobrenome' => $sobrenome
        );
        $this->session->set_flashdata('data', $data);
        $this->load->model('pesquisador');

        if(strlen($pessoa) <> 11 && strlen($pessoa) <> 14){ //cpf deve ter tamanho 11 e cnpj 14
            $this->session->set_userdata('key_fail', 'invalid');
        	echo '<script type="text/javascript">window.location.replace("cadastro");</script>';
        }

        if($this->pesquisador->existeCpf($pessoa) == 1){ //cpf é chave unica
            $this->session->set_userdata('key_fail', 'cpfcnpj');
        	echo '<script type="text/javascript">window.location.replace("cadastro");</script>';
        }

        if($senha != $senhac){
            $this->session->set_userdata('key_fail', 'pass');
        	echo '<script type="text/javascript">window.location.replace("cadastro");</script>';
        }

        $this->load->model('crud');
        $sql = array(
            'cpfcnpj' => $pessoa,
            'email'  => $email,
            'nome'  => $nome,
            'sobrenome' => $sobrenome,
            'dataini' => "STR_TO_DATE(".date('Y/m/d').", '%Y-%m-%d')",
            'status' => 1,
            'idgrupo' => 1
            );
        
        $tabela = 'usuario';
        $valor = $this->crud->Inserir($tabela,$sql);
        if($valor > 0){
                //true
                $iduser = $this->pesquisador->getIdUser($pessoa);
                $sql = array(
                    'idUsuario' => $iduser, 
                    'senha' => sha1($senha), 
                    'dtini' => "STR_TO_DATE(".date('Y/m/d').", '%Y-%m-%d')", 
                    'status' => 1
                );
                $tabela = 'senhas';
                $valor = $this->crud->Inserir($tabela,$sql);
                if($valor > 0){
                    //true total
                    $this->session->set_userdata('key_fail', 'sucess');
                    echo '<script type="text/javascript">window.location.replace("login");</script>';
                }else{
                    //false
                    $tabela = 'usuario';
                    $coluna = 'idusuario';
                    $valor = $this->crud->delete($tabela, $coluna, $iduser);
                    $this->session->set_userdata('key_fail', 'bd');
                    echo '<script type="text/javascript">window.location.replace("cadastro");</script>';
                }
        }else{
               //false
        }

	}
}