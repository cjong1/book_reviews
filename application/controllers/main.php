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
		$this->load->view('index');
	}

	public function register()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('alias', 'alias', 'required');
		$this->form_validation->set_rules('email', 'email address', 'valid_email|required|callback_email_check');
		$this->form_validation->set_rules('password', 'password', 'min_length[8]|required');
		$this->form_validation->set_rules('confirm', 'password', 'matches[password]');

		if($this->form_validation->run() === FALSE)
		{
			$this->session->set_flashdata('error', validation_errors());
			redirect('/');
		}
		else
		{
			$this->books->create_user($this->input->post());
			redirect('/');
		}

	}

		public function email_check()
			{
				$email = $this->input->post('email');
				$user = $this->books->get_user_by_email($email);

				if($user)
				{
					$this->form_validation->set_message('email_check', 'There is a login associated with this email address.');
					return FALSE;
				}
				else
				{
					return TRUE;
				}
			}

	public function login()
	{
		$email = $this->input->post('login_email');
		$password = md5($this->input->post('login_password'));
		$user = $this->books->get_user_by_email($email);

		if($user && $password == $user['password'])
		{	
			$current_user = array(
					'id' => $user['id'],
					'name' => $user['name'],					
					'alias' => $user['alias'],
					'email' => $user['email'],
				);
			$this->session->set_userdata($current_user);
			redirect('/main/books');
		}
		else
		{
			$this->session->set_flashdata('login_error', 'Invalid email or password');
			redirect('/');
		}
	}

	public function books()
	{
		$reviews = $this->books->get_reviews();
		$this->load->view('books', 
				array('review' => $reviews)
				);
	}

	public function add() 
	{
		$authors = $this->books->get_authors();
		$this->load->view('add', 
			array('author' => $authors)
			);
	}

	public function new_book()
	{
		$post = $this->input->post();
		if($this->input->post('new_author'))
		{
			$this->books->add_book_new($post);
			$book_id = $this->books->get_latest_book();
			redirect('/main/show/'.$book_id[0]->id);	
		}
		else
		{
			$this->books->add_book_old($post);
			redirect('/main/books');
		}
	}

	public function users($id)
	{
		$user = $this->books->get_user_by_id($id);
		$user['review'] = $this->books->review_count($id);
		$reviewed_books = $this->books->get_books_with_reviews_by_id($id);
		$this->load->view('users', 
			array('user' => $user, 'review' => $reviewed_books)
			);
	}

	public function show($id)
	{
		$reviews = $this->books->get_reviews_by_book($id);
		$this->load->view('book_review', array('reviews' => $reviews)
			);
	}

		public function new_review()
		{
			$book_id = $this->input->post('book');
			$this->books->add_review($this->input->post());
			redirect('/main/show/'.$book_id);
		}

	public function logout() 
	{
		$this->session->sess_destroy();
		redirect('/');
	}

}

//end of main controller