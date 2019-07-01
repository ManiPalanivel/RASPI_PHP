<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserController extends CI_Controller
{
  public function userController()
  {
	parent :: __construct();
	$this->load->model('user_model');
  }

  public function insert_user()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->user_model->insert(array('args'=>$data));
	echo $res;
  }

  public function validate_user()
  {
    $data = json_decode(file_get_contents("php://input"), TRUE);
  	$res =  $this->user_model->validate(array('args'=>$data));
  	echo $res;
  }

  public function get()
  {
      $id=$this->uri->segment(3);
      if($id > 0)
      {
           $res =  $this->user_model->get(array('id'=>$id));
           echo $res;
      }
      else
      {
           $res =  $this->user_model->get(array('id'=>0));
           echo $res;
      }
  }

  public function update_wallet()
  {
      $data = json_decode(file_get_contents("php://input"), TRUE);
      $res =  $this->user_model->update_wallet(array('args'=>$data));
      echo $res;
  }
}
?>
