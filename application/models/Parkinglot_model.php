<?php

 class Parkinglot_model extends CI_Model
 {
 	/**
	* Function to insert the parking lot information
	* @param array $obj
	* @return array $res
 	*/
	public function insert($obj)
	{
      $parking_lot_name = $obj['args']['parking_lot_name'];
	  $address = $obj['args']['address'];

      if($parking_lot_name != ""){
    	  $qry = "INSERT INTO parking_lot(parking_lot_name, address) VALUES ('$parking_lot_name','$address')";

    	  if($this->db->query($qry))
    	  {
            	$res['status'] = "Success";
            	return json_encode($res);
    	  }else {
            	$res['status'] = "Failure";
            	$res['error'] = 'Please check Parking lot information';
            	return json_encode($res);
    	  }
      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check Parking lot information';
            return json_encode($res);
      }

	 return json_encode($res);
	}

    /**
	* Function to get the slot information
	* @param array $obj
	* @return json array
 	*/
	public function get($obj)
	{
	 	if($obj['id'] > 0)
	 	{
	 		$id = $obj['id'];
	 		$sql = "SELECT * FROM slot WHERE parking_lot_id = '$id'";
	 	}
	 	else
	 	{
	 		$sql = "SELECT * FROM slot";
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
 }
?>
