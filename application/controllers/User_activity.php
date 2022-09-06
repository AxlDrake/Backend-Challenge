<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_activity extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->library('form_validation');
		$this->load->model('users_model', 'um');
		$this->load->model('user_activity_model', 'uam');			
	}

	public function get_conversations()
	{
		$response = ( $this->input->post() ) ? $this->input->post() : (array) json_decode($this->input->raw_input_stream);			
		
		$this->form_validation->set_data($response);
		$this->form_validation->set_rules('uid', 'uid', 'required|numeric');	

		$code = 200;
		$output = $this->output
						->set_status_header($code)
        				->set_content_type('application/json');

		if(!$this->form_validation->run())
		{
			$code = 400;
			return $output->set_status_header($code)
							->set_output(json_encode(array( 'code' => $code, 'errors' => $this->form_validation->error_array() )));			
		}	
		
		if(!$all_convos = $this->uam->get_by('uid', $response['uid']))
		{			
			$code = 400;
			return $output->set_status_header($code)
						->set_output( json_encode(array( 'code' => $code, 'error' => 'user doesnt exist in our data')) );
		}
		
		$res = array();						
		foreach ($all_convos as $index => $row) {						
			$res[$index] = array(
				'id'          => (int) $row['id'],
				'messageFrom' => $row['message_from'],
				'value'       => $row['message_text'],
				'timestamp'   => $row['timestamp'],
			);											
		}				
		 
		return $output->set_output(json_encode(array('code' => $code, 'payload' => $res)));		
	}

}
