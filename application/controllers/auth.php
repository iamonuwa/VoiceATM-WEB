<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 public function index()
 {
	if($this->session->userdata('logged_in'))
	{
		redirect('main', 'refresh');
	}
	else
	{
		$this->load->helper(array('form'));
		$this->load->view('home');
	}
 }
 
 public function login()
 {
	if($this->session->userdata('logged_in'))
	{
		redirect('main', 'refresh');
	}
	else
	{
	   $this->load->helper(array('form'));
	   $this->load->view('login');
	}
 }
 
 public function logout()
 {
   $this->load->helper(array('form'));
   $this->load->view('logout');
 }

}

?>

