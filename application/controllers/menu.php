<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {


	public function index()
	{
		$this->load->helper('url');
		@session_start();
		$this->load->view('topo');
		$this->load->view('menu_inicial');
		$_SESSION['FOOTER'] = '<center><h4 class="txt">&reg;COPA - 2021</h4></center>';
		$this->load->view('footer');
	}
}