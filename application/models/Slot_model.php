<?php

 class Slot_model extends CI_Model
 {
 	/**
	* Function to insert the slot information
	* @param array $obj
	* @return array $res
 	*/
	public function insert($obj)
	{
      $parking_lot_id = $obj['args']['parking_lot_id'];
	  $total = $obj['args']['total'];

      if($parking_lot_id != ""){

          $sel_id = "SELECT id FROM slot WHERE parking_lot_id = $parking_lot_id";
          $query = $this->db->query($sel_id);
          $result = $query->result_array();

          if(count($result) > 0)
    	  {
    	        $qry = "UPDATE slot SET slot_total = '$total' WHERE parking_lot_id = '$parking_lot_id'";
          }
    	  else
          {
    			$qry = "INSERT INTO slot(parking_lot_id, slot_total) VALUES ('$parking_lot_id','$total')";
    	  }

    	  if($this->db->query($qry))
    	  {
            	$res['status'] = "Success";
            	return json_encode($res);
    	  }else {
            	$res['status'] = "Failure";
            	$res['error'] = 'Please check Slot information';
            	return json_encode($res);
    	  }
      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check Slot information';
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

    /**
	* Function to update available slot information
	* @param array $obj
	* @return array $res
 	*/
	public function update_available($obj)
	{
      $parking_lot_id = $obj['args']['parking_lot_id'];
	  $available = $obj['args']['available'];

      if($parking_lot_id != ""){

    	  $qry = "UPDATE slot SET slot_available = '$available' WHERE parking_lot_id = '$parking_lot_id'";

    	  if($this->db->query($qry))
    	  {
            	$res['status'] = "Success";
            	return json_encode($res);
    	  }else {
            	$res['status'] = "Failure";
            	$res['error'] = 'Please check Slot information';
            	return json_encode($res);
    	  }
      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check Slot information';
            return json_encode($res);
      }

	 return json_encode($res);
	}

 }
?>
