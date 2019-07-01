<?php

 class Transaction_model extends CI_Model
 {
 	/**
	* Function to insert the transaction information
	* @param array $obj
	* @return array $res
 	*/
	public function insert($obj)
	{
      $reg_no = $obj['args']['reg_no'];
	  $time = $obj['args']['time'];

      if($reg_no != ""){

          $sel_id = "SELECT id,starttime FROM daily_transaction WHERE reg_no = '$reg_no' AND endtime IS NULL";
          $query = $this->db->query($sel_id);
          $result = $query->result_array();

          $endtime = (count($result) > 0) ? true : false;
          $id = (count($result) > 0) ? $result[0]['id'] : 0;

          if($endtime === false)
    	  {
    	        $qry = "INSERT INTO daily_transaction (reg_no, starttime) VALUES('$reg_no','$time')";
          }
    	  else
          {
    			$qry = "UPDATE daily_transaction SET reg_no = '$reg_no', endtime = '$time' WHERE id = '$id'";
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
