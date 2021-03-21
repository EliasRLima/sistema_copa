<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function index()
	{
		$this->load->library('session');
        if(!$this->session->has_userdata('key_fail')){
            $this->session->set_userdata('key_fail', '');
        }
		$this->load->helper('url');
        $this->load->view('topo');
		$this->load->view('login');
        $this->session->set_userdata('FOOTER', '<center><h4 class="txt">&reg;COPA - 2021</h4></center>');
		$this->load->view('footer');

	}
}


