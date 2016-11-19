
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_agama extends MY_Controller {

function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
	}

public function index()
	{
		$cek= $this->session->userdata('logged_in');
		$stts = $this->session->userdata('level');
		if(!empty($cek) && $stts=='01')
			{
				$data['menu'] = 'admin/admin_menu';
				$data['ptitle'] = '';
				$data['infobar'] = '';
				$data['konten'] = 'admin/dashboard';

				$this->theme->template($data);

			}

		else
		{
			header('location:'.base_url().'login');
		}

}

/* End of file Master_agama.php */

