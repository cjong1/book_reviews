<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('books');
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$email = $this->input->post('login_email');
		$password = md5($this->input->post('login_password'));
		$user = $this->books->get_user_by_email($email);
		$reviews = $this->books->get_reviews();

		if($user && $password == $user['password'])
		{
			$this->load->view('books', 
				array('user' => $user, 'review' => $reviews)
				);
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid email or password');
			redirect('/');
		}
	}
}