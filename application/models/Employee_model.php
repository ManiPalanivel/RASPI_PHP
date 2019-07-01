<?php

 class Employee_model extends CI_Model
 {
 	/**
	* Function to insert the employee information
	* @param array $obj
	* @return array $res
 	*/
	public function insert($obj)
	{
	  $user_name = $obj['args']['user_name'];
	  $first_name = $obj['args']['first_name'];
	  $last_name = $obj['args']['last_name'];
      $password = MD5($obj['args']['password']);
      $phone_number = $obj['args']['phone_number'];
      $email_id = $obj['args']['email_id'];
      $parking_lot_id = (int)$obj['args']['parking_lot_id'];

      if($user_name != ""){
    	  $qry = "INSERT INTO employee(username, first_name, last_name, password, phone_number, email_id, parking_lot_id) VALUES ('$user_name','$first_name', '$last_name', '$password', '$phone_number', '$email_id', $parking_lot_id)";

    	  if($this->db->query($qry))
    	  {
                $last_id_query = $this->db->query('SELECT LAST_INSERT_ID()');
                $row = $last_id_query->row_array();
                $emp_id = $row['LAST_INSERT_ID()'];

            	$res['status'] = "Success";
                $res['employee_id'] = $emp_id;
            	return json_encode($res);
    	  }else {
            	$res['status'] = "Failure";
            	$res['error'] = 'Please check employee information';
            	return json_encode($res);
    	  }
      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check employee information';
            return json_encode($res);
      }

	 return json_encode($res);
	}

	/**
	* Function to insert the employee information
	* @param array $obj
	* @return array $res
 	*/
	public function vlidate($obj)
	{
		$user_name = $obj['args']['user_name'];;
      	$password = MD5($obj['args']['password']);

      	if($user_name != ""){
    	  $qry = "SELECT user_id FROM employee WHERE username='$user_name' AND password='$password'";

          $query = $this->db->query($qry);
          $result = $query->result_array();

          if(count($result) > 0)
    	  {
    	         $res['user_id'] = $result[0]['user_id'];
    		     $res['status'] = "Success";
          }
    	  else
          {
    			$res['user_id'] = "0";
    			$res['status'] = "Failure";
    	  }
      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check username and password';
            return json_encode($res);
      }

	 return json_encode($res);
	}
 }
?>
