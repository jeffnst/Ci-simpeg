
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pangkat extends MY_Controller {

   function __construct()
	{
		parent::__construct();
		$this->load->model('pangkat_model','Pamodel');
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
				$data['konten'] = 'master_pangkat/view_pangkat';
                $data['skrip']='master_pangkat/master_pangkat_skrip';

				$this->theme->template($data);

			}

		else
		{
			header('location:'.base_url().'login');
		}
	} // end of method

public	function ajax_list()
	{
		$list = $this->Pamodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $hasil) {
			$no++;
			$row = array();
			$row[] = $hasil->nama_pangkat;
            $row[] = $hasil->golongan;
			$row[] = $hasil->ruang;
            $row[] = $hasil->level_pangkat;


			//add html for action
			$row[] = '<a class="btn btn-xs btn-raised  btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
					<a class="btn btn-xs btn-raised  btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Pamodel->count_all(),
						"recordsFiltered" => $this->Pamodel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->Pamodel->get_by_id($id);

		echo json_encode($data);
	}

public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nama_pangkat' => $this->input->post('nama_pangkat'),
				'golongan' => $this->input->post('golongan'),
				'ruang' => $this->input->post('ruang'),
                'level_pangkat' => $this->input->post('level_pangkat'),

			);
		$insert = $this->Pamodel->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nama_pangkat' => $this->input->post('nama_pangkat'),
				'golongan' => $this->input->post('golongan'),
				'ruang' => $this->input->post('ruang'),
                'level_pangkat' => $this->input->post('level_pangkat'),

			);
		$this->Pamodel->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Pamodel->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


 private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_pangkat') == '')
		{
			$data['inputerror'][] = 'nama_pangkat';
			$data['error_string'][] = 'Nama Pangkat is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('golongan') == '')
		{
			$data['inputerror'][] = 'golongan';
			$data['error_string'][] = 'Golongan is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('ruang') == '')
		{
			$data['inputerror'][] = 'ruang';
			$data['error_string'][] = 'ruang is required';
			$data['status'] = FALSE;
		}

        if($this->input->post('level_pangkat') == '')
		{
			$data['inputerror'][] = 'level_pangkat';
			$data['error_string'][] = 'level is required';
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
   print_r ($error);
   $this->session->set_flashdata('msg','Ada kesalah dalam upload'); 
  // redirect('master_pangkat'); 
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
     "nama_pangkat"=> $rowData[0][1],
     "golongan"=> $rowData[0][2],
     "ruang"=> $rowData[0][3],
     "level_pangkat"=> $rowData[0][4]
     
    );
    $this->db->insert("master_pangkat",$data);
   } 
   $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
   redirect('master_pangkat');
  }  
 } 

  public function export_excel()
 {
	 $data['excel']=$this->db->get('master_pangkat');
	 $this->load->view('master_pangkat/pangkat_export_excel',$data);
 }



}

/* End of file Master_pangkat.php */
/* */