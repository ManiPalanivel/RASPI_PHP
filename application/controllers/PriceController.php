<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PriceController extends CI_Controller
{
  public function priceController()
  {
	parent :: __construct();
	$this->load->model('price_model');
  }

  public function insert()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->price_model->insert(array('args'=>$data));
	echo $res;
  }

}
?>
