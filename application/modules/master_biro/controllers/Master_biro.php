
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_biro extends MY_Controller {

   function __construct()
	{
		parent::__construct();
		$this->load->model('Biro_model','Bmodel');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
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
				$data['konten'] = 'master_biro/view_biro';
                $data['skrip']='master_biro/master_biro_skrip';

				$this->theme->template($data);

			}

		else
		{
			header('location:'.base_url().'login');
		}
	} // end of method

public	function ajax_list()
	{
		$list = $this->Bmodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $hasil) {
			$no++;
			$row = array();
			$row[] = $hasil->urut_biro;
            $row[] = $hasil->kode_biro;
			$row[] = $hasil->nama_biro;


			//add html for action
			$row[] = '<a class="btn btn-xs btn-raised btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
					<a class="btn btn-xs btn-danger btn-raised" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Bmodel->count_all(),
						"recordsFiltered" => $this->Bmodel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->Bmodel->get_by_id($id);

		echo json_encode($data);
	}

public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'kode_biro' => $this->input->post('kode_biro'),
				'urut_biro' => $this->input->post('urut_biro'),
				'nama_biro' => $this->input->post('nama_biro'),

			);
		$insert = $this->Bmodel->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'urut_biro' => $this->input->post('urut_biro'),
                'kode_biro' => $this->input->post('kode_biro'),
				'nama_biro' => $this->input->post('nama_biro'),

			);
		$this->Bmodel->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Bmodel->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


 private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kode_biro') == '')
		{
			$data['inputerror'][] = 'kode_biro';
			$data['error_string'][] = 'Kode Biro is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('urut_biro') == '')
		{
			$data['inputerror'][] = 'urut_biro';
			$data['error_string'][] = 'No Urut Biro is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('nama_biro') == '')
		{
			$data['inputerror'][] = 'nama_biro';
			$data['error_string'][] = 'Nama Biro is required';
			$data['status'] = FALSE;
		}



		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

public function upload(){
  $fileName = $this->input->post('userfile',True);

  $config['upload_path'] = 'uploads/'; 
  $config['file_name'] = $fileName;
  $config['allowed_types'] = 'xls|xlsx|csv|ods|ots';
  $config['max_size'] = 100000;

  $this->load->library('upload', $config);
   $this->upload->initialize($config); 
  
  if (!$this->upload->do_upload('userfile')) {
   $error = array('error' => $this->upload->display_errors());
   $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
   redirect('master_biro'); 
  } else {
   $media = $this->upload->data();
   $inputFileName = 'uploads/'.$media['file_name'];
   
   try {
    $inputFileType = IOFactory::identify($inputFileName);
    $objReader = IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
   } catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
   }

   $sheet = $objPHPExcel->getSheet(0);
   $highestRow = $sheet->getHighestRow();
   $highestColumn = $sheet->getHighestColumn();

   for ($row = 2; $row <= $highestRow; $row++){  
     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
       NULL,
       TRUE,
       FALSE);
     $data = array(
     "id"=> $rowData[0][0],
     "urut_biro"=> $rowData[0][1],
     "kode_biro"=> $rowData[0][2],
     "nama_biro"=> $rowData[0][3]
     
    );
    $this->db->insert("master_biro",$data);
   } 
   $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
   redirect('master_biro');
  }  
 } 

  public function export_excel()
 {
	 $data[output]=$this->db->get('master_biro');
	 $this->load->view('master_biro/biro_export_excel',$data);
 }



}

/* End of file Master_biro.php */
/* */