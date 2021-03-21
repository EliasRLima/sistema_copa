<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller {


	public function index()
	{
		$this->load->library('session');
        if(!$this->session->has_userdata('key_fail')){
            $this->session->set_userdata('key_fail', '');
        }
		$data = array(
            'cpf'  => null,
            'email'  => null,
			'nome' => null,
			'sobrenome' => null
        );
		if($this->session->has_userdata('data')){
			$data = $this->session->flashdata('data');
		}
		$this->load->helper('url');
        $this->load->view('topo');
		$this->load->view('cadastro',$data);
        $this->session->set_userdata('FOOTER', '<center><h4 class="txt">&reg;COPA - 2021</h4></center>');
		$this->load->view('footer');

	}
}
