<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ParkingLotController extends CI_Controller
{
  public function parkingLotController()
  {
	parent :: __construct();
	$this->load->model('parkinglot_model');
  }

  public function insert()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->parkinglot_model->insert(array('args'=>$data));
	echo $res;
  }

  public function get()
  {
      $id=$this->uri->segment(3);
      if($id > 0)
    	{
    		 $res =  $this->parkinglot_model->get(array('id'=>$id));
    		 echo $res;
    	}
    	else
    	{
    		 $res =  $this->parkinglot_model->get(array('id'=>0));
    		 echo $res;
    	}
  }
}
?>
