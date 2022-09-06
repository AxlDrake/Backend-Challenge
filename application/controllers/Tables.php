<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Tables extends CI_Controller {

	public function __construct()
	{
		parent::__construct();		
		$this->load->library('grocery_CRUD');
	}

	public function users()
	{
		$crud = new grocery_CRUD();		
		$crud->set_table('users');	
		$crud->set_subject('Users', 'Users');

		$output = $crud->render();

		$this->_users_output($output);
	}

	function _users_output($output = null)
    {
        $this->load->view('users',$output);    
    }

	function user_activity()
	{
		$crud = new grocery_CRUD();		
		$crud->set_table('user_activities');	
		$crud->set_subject('Users Activity', 'Users Activity');

		$output = $crud->render();

		$this->_users_output($output);
	}


}
