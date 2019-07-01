<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SlotController extends CI_Controller
{
  public function slotController()
  {
	parent :: __construct();
	$this->load->model('slot_model');
  }

  public function insert()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->slot_model->insert(array('args'=>$data));
	echo $res;
  }

  public function update_available()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->slot_model->update_available(array('args'=>$data));
	echo $res;
  }

  public function get()
  {
      $id=$this->uri->segment(3);
      if($id > 0)
    	{
    		 $res =  $this->slot_model->get(array('id'=>$id));
    		 echo $res;
    	}
    	else
    	{
    		 $res =  $this->slot_model->get(array('id'=>0));
    		 echo $res;
    	}
  }
}
?>
