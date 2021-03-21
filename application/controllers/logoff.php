<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logoff extends CI_Controller {


	public function index()
	{
        error_reporting(0);
        $this->load->library('session');
		$this->session->unset_userdata('LOGIN');
        $this->session->unset_userdata('GRUPO');
        echo '<script type="text/javascript">window.location.replace("login");</script>';
		
	}
}