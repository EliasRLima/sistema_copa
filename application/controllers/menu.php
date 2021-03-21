<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {


	public function index()
	{
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->view('topo');
		$this->load->view('menu_inicial');
		$this->session->set_userdata('FOOTER', '<center><h4 class="txt">&reg;COPA - 2021</h4></center>');
		$this->load->view('footer');
	}
}