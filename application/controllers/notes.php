<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('note');
		//$this->output->enable_profiler();
	}

	public function index()
	{
		//echo base_url();
		echo "this is notes page";
		echo "Welcome to CodeIgniter. The default Controller is Main.php";
		echo $this->note->show();
		
		//var dump the data

		//$this->load->view("home_page");
	}

}

//end of main controller