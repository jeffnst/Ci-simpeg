
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_pendidikan extends MY_Controller {

   function __construct()
	{
		parent::__construct();
		$this->load->model('Pendidikan_model','Pmodel');
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
				$data['konten'] = 'master_pendidikan/view_pendidikan';
                $data['skrip']='master_pendidikan/master_pendidikan_skrip';

				$this->theme->template($data);

			}

		else
		{
			header('location:'.base_url().'login');
		}
	} // end of method

public	function ajax_list()
	{
		$list = $this->Pmodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $hasil) {
			$no++;
			$row = array();
			$row[] = $hasil->jenis_pendidikan;
            $row[] = $hasil->kode_pendidikan;
			$row[] = $hasil->level_pendidikan;


			//add html for action
			$row[] = '<a class="btn btn-xs btn-raised btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
					<a class="btn btn-xs btn-raised btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Pmodel->count_all(),
						"recordsFiltered" => $this->Pmodel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->Pmodel->get_by_id($id);

		echo json_encode($data);
	}

public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'jenis_pendidikan' 		=> $this->input->post('jenis_pendidikan'),
				'kode_pendidikan'  		=> $this->input->post('kode_pendidikan'),
				'level_pendidikan'		=> $this->input->post('level_pendidikan'),

			);
		$insert = $this->Pmodel->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'jenis_pendidikan' 		=> $this->input->post('jenis_pendidikan'),
				'kode_pendidikan'		=> $this->input->post('kode_pendidikan'),
				'level_pendidikan' 		=> $this->input->post('level_pendidikan'),

			);
		$this->Pmodel->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Pmodel->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


 private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('jenis_pendidikan') == '')
		{
			$data['inputerror'][] = 'jenis_pendidikan';
			$data['error_string'][] = 'Jenis pendidikan is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('kode_pendidikan') == '')
		{
			$data['inputerror'][] = 'kode_pendidikan';
			$data['error_string'][] = 'Kode pendidikan is required';
			$data['status'] = FALSE;
		}


		if($this->input->post('level_pendidikan') == '')
		{
			$data['inputerror'][] = 'level_pendidikan';
			$data['error_string'][] = 'Level pendidikan is required';
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
   redirect('master_pendidikan'); 
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
     "jenis_pendidikan"=> $rowData[0][1],
     "kode_pendidikan"=> $rowData[0][2],
     "level_pendidikan"=> $rowData[0][3]
     
    );
    $this->db->insert("master_pendidikan",$data);
   } 
   $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
   redirect('master_pendidikan');
  }  
 } 

  public function export_excel()
 {
	 $data[output]=$this->db->get('master_pendidikan');
	 $this->load->view('master_pendidikan/pendidikan_export_excel',$data);
 }



}

/* End of file Master_pendidikan.php */
/* */