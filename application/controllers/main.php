
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Main extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   
   if(!$this->session->userdata('logged_in'))
   {
		//If no session, redirect to login page
		redirect('auth', 'refresh');
   }
   
    $this->load->model('auth_model');
	$this->load->helper('url');
	$this->load->database();
	$this->load->library('form_validation');
   
 }

	function index()
	{
		redirect('main/transaction', 'refresh'); 
	}
 
 function transaction()
 {
	$session_data = $this->session->userdata('logged_in');
    $this->data['name'] = $session_data['name'];
	$this->data['profile_image'] = $session_data['profile_image'];
	
	//$id = $session_data['id'];
	
    $this->load->view('transaction', $this->data);
	
	//$account_no = $this->auth_model->get_account_no_by_id($id);
   
 }
 
 function cash_withdrawal()
 {
    $session_data = $this->session->userdata('logged_in');
    $this->data['name'] = $session_data['name'];
	$this->data['profile_image'] = $session_data['profile_image'];
	 
	$this->form_validation->set_rules('withdrawal_amount', 'withdrawal_amount', 'trim|required|xss_clean');
	
	if(isset($_POST) && !empty($_POST) && $this->input->post('withdrawal_amount'))
	{
		$withdrawal_amount = $this->input->post('withdrawal_amount');
		//$account_no = $session_data['account_no'];
		
		$id = $session_data['id'];
		$account_no = $this->auth_model->get_account_no_by_id($id);
		
		if($this->auth_model->withdraw_amount($withdrawal_amount, $account_no))
		{
			$this->data['account_balance'] = $this->auth_model->account_balance($account_no);
			$this->load->view('cash-withdrawal-successful', $this->data);
		}
		else
		{
			$this->data['account_balance'] = $this->auth_model->account_balance($account_no);
			$this->load->view('cash-withdrawal-failed', $this->data);
		}
	}
	else
	{
		$this->load->view('cash-withdrawal', $this->data);
	}	
 }
 
 function mini_statement()
 {
    $session_data = $this->session->userdata('logged_in');
    $this->data['name'] = $session_data['name'];
	$this->data['profile_image'] = $session_data['profile_image'];
	
	//$account_no = $session_data['account_no'];
	
	$id = $session_data['id'];
	$account_no = $this->auth_model->get_account_no_by_id($id);
	
	$this->data['account_details'] = $this->auth_model->account_details($account_no);
    $this->load->view('mini-statement', $this->data);
 }
 
 function balance_enquiry()
 {
    $session_data = $this->session->userdata('logged_in');
    $this->data['name'] = $session_data['name'];
	$this->data['profile_image'] = $session_data['profile_image'];
	
	//$account_no = $session_data['account_no'];
	
	$id = $session_data['id'];
	$account_no = $this->auth_model->get_account_no_by_id($id);
	
	$this->data['account_balance'] = $this->auth_model->account_balance($account_no);
    $this->load->view('balance-enquiry', $this->data);
 }

 function logout()
 {
   $this->session->unset_userdata('logged_in');
   session_destroy();
   redirect('auth/logout', 'refresh');
 }

}

?>

