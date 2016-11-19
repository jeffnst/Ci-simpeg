
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_agama extends MY_Controller {

   function __construct()
	{
		parent::__construct();
		$this->load->model('Agama_model','Amodel');
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
				$data['konten'] = 'master_agama/view_agama';
                $data['skrip']='master_agama/master_agama_skrip';

				$this->theme->template($data);

			}

		else
		{
			header('location:'.base_url().'login');
		}
	} // end of method

public	function ajax_list()
	{
		$list = $this->Amodel->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $hasil) {
			$no++;
			$row = array();
			
			$row[] = $hasil->agama;


			//add html for action
			$row[] = '<a class="btn btn-raised btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
					<a class="btn btn-raised btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_data('."'".$hasil->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Amodel->count_all(),
						"recordsFiltered" => $this->Amodel->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->Amodel->get_by_id($id);

		echo json_encode($data);
	}

public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'agama' => $this->input->post('agama'),
				

			);
		$insert = $this->Amodel->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'agama' => $this->input->post('agama'),
                
			);
		$this->Amodel->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Amodel->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


 private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('agama') == '')
		{
			$data['inputerror'][] = 'agama';
			$data['error_string'][] = 'Agama is required';
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
   redirect('master_agama'); 
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
     "agama"=> $rowData[0][1]
     
     
    );
    $this->db->insert("master_agama",$data);
   } 
   $this->session->set_flashdata('msg','Berhasil upload ...!!'); 
   redirect('master_agama');
  }  
 } 

  public function export_excel()
 {
	 $data[output]=$this->db->get('master_agama');
	 $this->load->view('master_agama/agama_export_excel',$data);
 }



}

/* End of file Master_agama.php */
/* */