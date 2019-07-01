<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EmployeeController extends CI_Controller
{
  public function employeeController()
  {
	parent :: __construct();
	$this->load->model('employee_model');
  }

  public function insert_employee()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->employee_model->insert(array('args'=>$data));
	echo $res;
  }

  public function validate_employee()
  {
	$data = json_decode(file_get_contents("php://input"), TRUE);
	$res =  $this->employee_model->validate(array('args'=>$data));
	echo $res;
  }
}
?>
