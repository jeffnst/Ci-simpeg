<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{

function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
	}


	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			$this->load->view('login');
		}
		else
		{
			$st = $this->session->userdata('level');
			if($st=='01')
			{
				header('location:'.base_url().'admin');
			}
			else if($st=='02')
			{
				header('location:'.base_url().'operator');
			}

		}


	}

	public function getlogin()
	{
		$usr = $this->input->post('username');
		$pwd = $this->input->post('password');
		$this->login_model->getLoginData($usr,$pwd);
	}

	public function logout()
	{
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'login');
		}
		else
		{
			$this->session->sess_destroy();
			header('location:'.base_url().'login');
			$this->session->set_flashdata('logout_info','<div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert">
         <i class="icon-remove"></i>
     </button>
     Anda telah keluar dari aplikasi
     <br />
 </div>');

		}
}

}
