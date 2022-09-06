<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');
		$this->load->model('users_model', 'um');				
	}


	public function login()
	{	
		//Get data from form-data type or Raw json post
		$data = ( $this->input->post() ) ? $this->input->post() : (array) json_decode($this->input->raw_input_stream);		

		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('password', 'Password', 'required');		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_exists_in_database');	

		$response = $this->output->set_content_type('application/json');			
		
		if(!$this->form_validation->run())
		{
			return $response->set_status_header(400)
						->set_output(json_encode( array( 'errors' => $this->form_validation->error_array()) ) );
		}

		if(!$uid = $this->um->get_user($data['email'], $data['password']))
		{		
			return $response->set_status_header(401)
						->set_output(json_encode( array( 'errors' => array( 'password' => 'The password for the user is invalid.')) ) );
		}			
		
		return $response->set_status_header(201)
						->set_output( json_encode( array('uid' => $uid , 'message' => 'Successfully logged in.') ) );
		
	}

	public function register()
	{
		$data = ( $this->input->post() ) ? $this->input->post() : (array) json_decode($this->input->raw_input_stream);	

		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');		
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');	
		
		$response = $this->output
						->set_status_header(200)
        				->set_content_type('application/json');

		if(!$this->form_validation->run())
		{
			return $response->set_status_header(400)
							->set_output(json_encode(array( 'errors' => $this->form_validation->error_array() )));			
		}

		$uid = $this->um->insert_user($data['email'], $data['password']);
		return $response->set_status_header(201)
						->set_output(json_encode( array('uid' => $uid, 'message' => 'user created correctly.') ));
	}
	

	public function exists_in_database($email)
	{
		if (!$this->um->check_email($email))
		{	
			$this->form_validation->set_message('exists_in_database', 'Please enter an existing email');
			return FALSE;
		}
		
		return TRUE;		
	}

}
