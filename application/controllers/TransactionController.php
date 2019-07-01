<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class TransactionController extends CI_Controller
{
  public function transactionController()
  {
	parent :: __construct();
	$this->load->model('transaction_model');
  }

  public function insert()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->transaction_model->insert(array('args'=>$data));
	echo $res;
  }

}
?>
