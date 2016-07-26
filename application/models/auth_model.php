<?php
Class Auth_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		
		$this->load->database();
	}
	public function login($username, $password)
	{
	   $this -> db -> select('id, username, password, name, account_no, profile_image');
	   $this -> db -> from('users');
	   $this -> db -> where('username', $username);
	   $this -> db -> where('password', MD5($password));
	   $this -> db -> limit(1);

	   $query = $this -> db -> get();
	   
	 //  $query=$this->db->query("SELECT username, password, name, account_no, profile_image FROM users WHERE username = '$username' AND password = '".md5($password)."' ORDER BY timestamp ASC LIMIT 0, 10");
		

	   if($query -> num_rows() == 1)
	   {
			foreach ($query->result_array() as $row)
			{
			   $account_no = $row['account_no'];
			   echo $account_no;
			}
	   
		 return $query->result();
	   }
	   else
	   {
		 return false;
	   }
	}
	
	public function get_account_no_by_id($id)
	{
		$query=$this->db->query("SELECT account_no FROM users WHERE id = '$id'");
		
		if ($query == FALSE || $query->num_rows == 0)
		{
			return FALSE;
		}
		else
		{
			$row = $query->row();
			return $row->account_no;
		}
	}
	
	public function account_balance($account_no)
	{
		$query=$this->db->query("SELECT timestamp, balance FROM accounts WHERE account_no = '$account_no' ORDER BY timestamp DESC LIMIT 0, 1");
		
		if ($query == FALSE || $query->num_rows == 0)
		{
			return FALSE;
		}
		else
		{
			$row = $query->row();
			return $row->balance;
		}
	}
 
	public function account_details($account_no)
	{
		$query=$this->db->query("SELECT id, account_no, balance, transaction, transaction_type, timestamp FROM accounts WHERE account_no = '$account_no' ORDER BY timestamp DESC LIMIT 10");
		
		if ($query == FALSE)
		{
			return FALSE;
		}
		else
		{
			return $query->result_array();
		}
	}
	
	public function withdraw_amount($withdraw_amount, $account_no)
	{
		$query=$this->db->query("SELECT id, account_no, balance, transaction, transaction_type, timestamp FROM accounts WHERE account_no = '$account_no' ORDER BY timestamp DESC LIMIT 0, 1");
		
		if ($query == FALSE)
		{
			return FALSE;
		}
		else
		{
			foreach ($query->result_array() as $row)
			{
			   $balance = $row['balance'];
			   $id = $row['id']++;
			}
			
			if($balance >= $withdraw_amount)
			{
				$final_balance = $balance - $withdraw_amount;
				$current_timestamp = time();
				
				$query2 = $this->db->query("INSERT INTO accounts (account_no, balance, transaction, transaction_type, timestamp) VALUES ('$account_no', '$final_balance', '$withdraw_amount', '0', '$current_timestamp')");
				
				return TRUE;
			}
			else
			{
				return FALSE;
			}	
		}
	}
}
?>

