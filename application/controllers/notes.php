<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('note');
		// $this->output->enable_profiler();
	}

	public function index_html()
	{
		$this->show_partial();
	}

	public function index()
	{
		// var_dump($this->note->show());
		// die();
		$this->load->view("notes");
	}

	public function create() 
	{
		$new_note = $this->input->post();
		$insert = $this->note->create($new_note);
		$this->show_partial();
		// redirect('/');
	}

	public function delete()
	{
		$this->note->delete($this->input->post('id'));
		$this->show_partial();
	}

	public function update()
	{
		$update = $this->note->update($this->input->post('id'), $this->input->post('description') );
		$this->show_partial();
	}

	private function show_partial()
	{
		$results['all_notes'] = $this->note->show();
		$this->load->view("partials/note_data", $results);
	}
}

//end of notes controller