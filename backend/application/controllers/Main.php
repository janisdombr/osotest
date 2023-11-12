<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this currency controller.
	 * currency_converter view loading VUE.js app
	 * 
	 */
	public function index()
	{
		$this->load->view('main/index');
	}
}
?>
