<?php

 class Price_model extends CI_Model
 {
 	/**
	* Function to insert the price information
	* @param array $obj
	* @return array $res
 	*/
	public function insert($obj)
	{
      $parking_lot_id = $obj['args']['parking_lot_id'];
	  $vehicle_type = $obj['args']['vehicle_type'];
      $price = $obj['args']['price'];

      if($parking_lot_id != ""){

          $sel_id = "SELECT id FROM price WHERE parking_lot_id = $parking_lot_id AND vehicle_option_id = $vehicle_type";
          $query = $this->db->query($sel_id);
          $result = $query->result_array();

          if(count($result) > 0)
    	  {
    	        $qry = "UPDATE price SET price_per_hour = $price WHERE parking_lot_id = $parking_lot_id AND vehicle_option_id = $vehicle_type";
          }
    	  else
          {
    			$qry = "INSERT INTO price(parking_lot_id, vehicle_option_id, price_per_hour) VALUES ($parking_lot_id, $vehicle_type, $price)";
    	  }

    	  if($this->db->query($qry))
    	  {
            	$res['status'] = "Success";
            	return json_encode($res);
    	  }else {
            	$res['status'] = "Failure";
            	$res['error'] = 'Please check Price information';
            	return json_encode($res);
    	  }
      }else {
            $res['status'] = "Failure";
            $res['error'] = 'Please check Price information';
            return json_encode($res);
      }

	 return json_encode($res);
	}

 }
?>
