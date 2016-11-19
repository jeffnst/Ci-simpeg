
<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Laporan_umum extends MY_Controller
{

function __construct()
	{
		parent::__construct();
		$this->load->model('Lap_umum_model');
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
				$data['konten'] = 'laporan_umum/view_lap_umum';
				$data['skrip']='laporan_umum/lap_umum_skrip';

				$this->theme->template($data);

			}

		else
		{
			header('location:'.base_url().'login');
		}
    }

public function umum_list()
	{


		$list = $this->Lap_umum_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $person->nip;
			$row[] = $person->gelar_dpn.$person->nama.$person->gelar_blkg;
			$row[] = $person->gender;
			$row[] = $person->pangkat;
			$row[] = $person->jabatan;
			
			
			

			//add html for action
			$row[] = '<a class="btn btn-xs btn-raised btn-primary " href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->uid."'".')"><i class="glyphicon glyphicon-zoom-in"></i> Detail </a>
					<a class="btn btn-xs btn-raised btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$person->uid."'".')"><i class="fa fa-file-pdf-o"></i> PDF </a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Lap_umum_model->count_all(),
						"recordsFiltered" => $this->Lap_umum_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function biodata_edit($uid)
	{
		$data = $this->Lap_umum_model->get_by_id($uid);

		echo json_encode($data);
	}

	public function biodata_add()
	{
		$this->_biodata_validate();

		$data = array(
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'gender' => $this->input->post('gender'),
				'gelar_dpn' => $this->input->post('gelar_dpn'),
				'gelar_blkg' => $this->input->post('gelar_blkg'),
				'pob' => $this->input->post('pob'),
				'dob' => $this->input->post('dob'),
				'agama' => $this->input->post('agama'),
				'ktp' => $this->input->post('ktp'),
				'npwp' => $this->input->post('npwp'),
				'paspor' => $this->input->post('paspor'),
				'alamat_ktp' => $this->input->post('alamat_ktp'),
				'alamat_akhir' => $this->input->post('alamat_akhir'),
				'pangkat' => $this->input->post('pangkat'),
				'tmt_pangkat' => $this->input->post('tmt_pangkat'),
				'jabatan' => $this->input->post('jabatan'),
				'tmt_jabatan' => $this->input->post('tmt_jabatan'),
				'masa_kerja' => $this->input->post('masa_kerja'),
				
				);

		if(!empty($_FILES['foto']['name']))
		{
			$upload = $this->_do_upload();
			$data['foto'] = $upload;
		}

		$insert = $this->Lap_umum_model->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function biodata_update()
	{
		$this->_biodata_validate();
		$data = array(
				'nip' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'gender' => $this->input->post('gender'),
				'gelar_dpn' => $this->input->post('gelar_dpn'),
				'gelar_blkg' => $this->input->post('gelar_blkg'),
				'pob' => $this->input->post('pob'),
				'dob' => $this->input->post('dob'),
				'agama' => $this->input->post('agama'),
				'ktp' => $this->input->post('ktp'),
				'npwp' => $this->input->post('npwp'),
				'paspor' => $this->input->post('paspor'),
				'alamat_ktp' => $this->input->post('alamat_ktp'),
				'alamat_akhir' => $this->input->post('alamat_akhir'),
				'pangkat' => $this->input->post('pangkat'),
				'tmt_pangkat' => $this->input->post('tmt_pangkat'),
				'jabatan' => $this->input->post('jabatan'),
				'tmt_jabatan' => $this->input->post('tmt_jabatan'),
				'masa_kerja' => $this->input->post('masa_kerja'),
			);

		if($this->input->post('remove_foto')) // if remove photo checked
		{
			if(file_exists('foto/'.$this->input->post('remove_foto')) && $this->input->post('remove_foto'))
				unlink('foto/'.$this->input->post('remove_foto'));
			$data['foto'] = '';
		}

		if(!empty($_FILES['foto']['name']))
		{
			$upload = $this->_do_upload();

			//delete file
			$person = $this->Lap_umum_model->get_by_id($this->input->post('uid'));
			if(file_exists('foto/'.$person->foto) && $person->foto)
				unlink('foto/'.$person->foto);

			$data['foto'] = $upload;
		}

		$this->Lap_umum_model->update(array('uid' => $this->input->post('uid')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function biodata_delete($uid)
	{
		//delete file
		$person = $this->Lap_umum_model->get_by_id($uid);
		if(file_exists('foto/'.$person->foto) && $person->foto)
			unlink('foto/'.$person->foto);

		$this->Lap_umum_model->delete_by_id($uid);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'foto/';
				$config['allowed_types']        = 'gif|jpg|png';
				$config['max_size']             = 1000; //set max size allowed in Kilobyte
				$config['max_width']            = 1000; // set max width image allowed
				$config['max_height']           = 1000; // set max height allowed
				$config['file_name']            = $this->input->post('nip'); //just milisecond timestamp fot unique name

				$this->load->library('upload', $config);

				if(!$this->upload->do_upload('foto')) //upload and validate
				{
						$data['inputerror'][] = 'foto';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _biodata_validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nip') == '')
		{
			$data['inputerror'][] = 'nip';
			$data['error_string'][] = 'NIP is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('gender') == '')
		{
			$data['inputerror'][] = 'gender';
			$data['error_string'][] = 'gender is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('pob') == '')
		{
			$data['inputerror'][] = 'pob';
			$data['error_string'][] = 'Tempat Lahir is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Tanggal lahir is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('agama') == '')
		{
			$data['inputerror'][] = 'agama';
			$data['error_string'][] = 'agama is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('ktp') == '')
		{
			$data['inputerror'][] = 'ktp';
			$data['error_string'][] = 'ktp is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('npwp') == '')
		{
			$data['inputerror'][] = 'npwp';
			$data['error_string'][] = 'npwp is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('alamat_ktp') == '')
		{
			$data['inputerror'][] = 'alamat_ktp';
			$data['error_string'][] = 'Alamat KTP is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('alamat_akhir') == '')
		{
			$data['inputerror'][] = 'alamat_akhir';
			$data['error_string'][] = 'Alamat Sekarang is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('pangkat') == '')
		{
			$data['inputerror'][] = 'pangkat';
			$data['error_string'][] = 'Pangkat is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('tmt_pangkat') == '')
		{
			$data['inputerror'][] = 'tmt_pangkat';
			$data['error_string'][] = 'TMT Pangkat is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('jabatan') == '')
		{
			$data['inputerror'][] = 'jabatan';
			$data['error_string'][] = 'Jabatan is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('tmt_jabatan') == '')
		{
			$data['inputerror'][] = 'tmt_jabatan';
			$data['error_string'][] = 'TMT Jabatan is required';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}




}

/* End of file Biodata.php */
