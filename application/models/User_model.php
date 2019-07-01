<?php

 class User_model extends CI_Model
 {
 	/**
	* Function to insert the user information
	* @param array $obj
	* @return array $res
 	*/
	public function insert($obj)
	{
	  $user_name = $obj['args']['user_name'];
	  $first_name = $obj['args']['first_name'];
	  $last_name = $obj['args']['last_name'];
      $password = MD5($obj['args']['password']);
      $wallet = $obj['args']['wallet'];
      $phone_number = $obj['args']['phone_number'];
      $email_id = $obj['args']['email_id'];
      $use_wallet = (int)$obj['args']['use_wallet'];

      $vehicle_details = $obj['args']['vehicle_details'];

      if($user_name != ""){
    	  $qry = "INSERT INTO user(username, first_name, last_name, password, wallet, phone_number, email_id, use_wallet) VALUES ('$user_name','$first_name', '$last_name', '$password', '$wallet', '$phone_number', '$email_id', $use_wallet)";

    	  if($this->db->query($qry))
    	  {
                $last_id_query = $this->db->query('SELECT LAST_INSERT_ID()');
                $row = $last_id_query->row_array();
                $user_id = $row['LAST_INSERT_ID()'];

                for ($i=0; $i < count($vehicle_details) - 1; $i++) {
                    $reg_number = $vehicle_details[$i]['reg_number'];
                    $vehicle_type_id = $vehicle_details[$i]['vehicle_type_id'];

                    $vehicle_qry = "INSERT INTO vehicle(reg_no, vehicle_type_id, user_id) VALUES ('$reg_number', $vehicle_type_id, $user_id)";
                    $this->db->query($vehicle_qry);
                }

            	$res['status'] = "Success";
                $res['user_id'] = $user_id;
            	return json_encode($res);
    	  }else {
            	$res['status'] = "Failure";
            	$res['error'] = 'Please check user information';
            	return json_encode($res);
    	  }
      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check user information';
            return json_encode($res);
      }

	 return json_encode($res);
	}

    /**
	* Function to validate the user credentials
	* @param array $obj
	* @return array $res
 	*/
	public function validate($obj)
	{
	  $user_name = $obj['args']['user_name'];;
      $password = MD5($obj['args']['password']);

      if($user_name != ""){
    	  $qry = "SELECT user_id FROM user WHERE username='$user_name' AND password='$password'";

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

    /**
    * Function to get the user information
    * @param array $obj
    * @return json array
    */
    public function get($obj)
    {
        if($obj['id'] > 0)
        {
            $id = $obj['id'];
            $sql = "select user.*,vehicle.reg_no, vehicle.vehicle_type_id  from user left join vehicle on vehicle.user_id = user.user_id where user.user_id = '$id'";
        }
        else
        {
            $sql = "select user.*,vehicle.reg_no, vehicle.vehicle_type_id  from user left join vehicle on vehicle.user_id = user.user_id";
        }

        $query = $this->db->query($sql);
        $result = $query->result_array();
        if(count($result) > 0)
        {
            $res['msg'] = $result;
            $res['status'] = "Success";
        }
        else
        {
            $res['msg'] = "No info found";
            $res['status'] = "Failure";
        }
     return json_encode($res);
    }

    /**
    * Function to update wallet information
    * @param array $obj
    * @return array $res
    */
    public function update_wallet($obj)
    {
      $user_id = $obj['args']['user_id'];
      $amount = (int)$obj['args']['amount'];

      if($user_id != ""){
          $qry = "SELECT user_id FROM user WHERE user_id=$user_id";

          $query = $this->db->query($qry);
          $result = $query->result_array();

          if(count($result) > 0)
    	  {
              $qry = "UPDATE user SET wallet = $amount WHERE user_id = $user_id";

              if($this->db->query($qry))
              {
                    $res['status'] = "Success";
                    return json_encode($res);
              }else {
                    $res['status'] = "Failure";
                    $res['error'] = 'Please check wallet information';
                    return json_encode($res);
              }
          }else {
              $res['status'] = "Failure";
              $res['error'] = 'Please user information';
              return json_encode($res);
          }


      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check user information';
            return json_encode($res);
      }

     return json_encode($res);
    }
 }
?>
