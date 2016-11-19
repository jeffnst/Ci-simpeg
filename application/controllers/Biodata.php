<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Biodata extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Biodata_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'biodata/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'biodata/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'biodata/index.html';
            $config['first_url'] = base_url() . 'biodata/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Biodata_model->total_rows($q);
        $biodata = $this->Biodata_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'biodata_data' => $biodata,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('biodata/biodata_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Biodata_model->get_by_id($id);
        if ($row) {
            $data = array(
		'uid' => $row->uid,
		'nip' => $row->nip,
		'nama' => $row->nama,
		'pob' => $row->pob,
		'dob' => $row->dob,
		'agama' => $row->agama,
		'ktp' => $row->ktp,
		'paspor' => $row->paspor,
		'alamat_ktp' => $row->alamat_ktp,
		'alamat_akhir' => $row->alamat_akhir,
		'pangkat' => $row->pangkat,
		'tmt_pangkat' => $row->tmt_pangkat,
		'jabatan' => $row->jabatan,
		'tmt_jabatan' => $row->tmt_jabatan,
		'masa_kerja' => $row->masa_kerja,
		'last_update' => $row->last_update,
	    );
            $this->load->view('biodata/biodata_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('biodata'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('biodata/create_action'),
	    'uid' => set_value('uid'),
	    'nip' => set_value('nip'),
	    'nama' => set_value('nama'),
	    'pob' => set_value('pob'),
	    'dob' => set_value('dob'),
	    'agama' => set_value('agama'),
	    'ktp' => set_value('ktp'),
	    'paspor' => set_value('paspor'),
	    'alamat_ktp' => set_value('alamat_ktp'),
	    'alamat_akhir' => set_value('alamat_akhir'),
	    'pangkat' => set_value('pangkat'),
	    'tmt_pangkat' => set_value('tmt_pangkat'),
	    'jabatan' => set_value('jabatan'),
	    'tmt_jabatan' => set_value('tmt_jabatan'),
	    'masa_kerja' => set_value('masa_kerja'),
	    'last_update' => set_value('last_update'),
	);
        $this->load->view('biodata/biodata_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nip' => $this->input->post('nip',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'pob' => $this->input->post('pob',TRUE),
		'dob' => $this->input->post('dob',TRUE),
		'agama' => $this->input->post('agama',TRUE),
		'ktp' => $this->input->post('ktp',TRUE),
		'paspor' => $this->input->post('paspor',TRUE),
		'alamat_ktp' => $this->input->post('alamat_ktp',TRUE),
		'alamat_akhir' => $this->input->post('alamat_akhir',TRUE),
		'pangkat' => $this->input->post('pangkat',TRUE),
		'tmt_pangkat' => $this->input->post('tmt_pangkat',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'tmt_jabatan' => $this->input->post('tmt_jabatan',TRUE),
		'masa_kerja' => $this->input->post('masa_kerja',TRUE),
		'last_update' => $this->input->post('last_update',TRUE),
	    );

            $this->Biodata_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('biodata'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Biodata_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('biodata/update_action'),
		'uid' => set_value('uid', $row->uid),
		'nip' => set_value('nip', $row->nip),
		'nama' => set_value('nama', $row->nama),
		'pob' => set_value('pob', $row->pob),
		'dob' => set_value('dob', $row->dob),
		'agama' => set_value('agama', $row->agama),
		'ktp' => set_value('ktp', $row->ktp),
		'paspor' => set_value('paspor', $row->paspor),
		'alamat_ktp' => set_value('alamat_ktp', $row->alamat_ktp),
		'alamat_akhir' => set_value('alamat_akhir', $row->alamat_akhir),
		'pangkat' => set_value('pangkat', $row->pangkat),
		'tmt_pangkat' => set_value('tmt_pangkat', $row->tmt_pangkat),
		'jabatan' => set_value('jabatan', $row->jabatan),
		'tmt_jabatan' => set_value('tmt_jabatan', $row->tmt_jabatan),
		'masa_kerja' => set_value('masa_kerja', $row->masa_kerja),
		'last_update' => set_value('last_update', $row->last_update),
	    );
            $this->load->view('biodata/biodata_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('biodata'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('uid', TRUE));
        } else {
            $data = array(
		'nip' => $this->input->post('nip',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'pob' => $this->input->post('pob',TRUE),
		'dob' => $this->input->post('dob',TRUE),
		'agama' => $this->input->post('agama',TRUE),
		'ktp' => $this->input->post('ktp',TRUE),
		'paspor' => $this->input->post('paspor',TRUE),
		'alamat_ktp' => $this->input->post('alamat_ktp',TRUE),
		'alamat_akhir' => $this->input->post('alamat_akhir',TRUE),
		'pangkat' => $this->input->post('pangkat',TRUE),
		'tmt_pangkat' => $this->input->post('tmt_pangkat',TRUE),
		'jabatan' => $this->input->post('jabatan',TRUE),
		'tmt_jabatan' => $this->input->post('tmt_jabatan',TRUE),
		'masa_kerja' => $this->input->post('masa_kerja',TRUE),
		'last_update' => $this->input->post('last_update',TRUE),
	    );

            $this->Biodata_model->update($this->input->post('uid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('biodata'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Biodata_model->get_by_id($id);

        if ($row) {
            $this->Biodata_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('biodata'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('biodata'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nip', 'nip', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('pob', 'pob', 'trim|required');
	$this->form_validation->set_rules('dob', 'dob', 'trim|required');
	$this->form_validation->set_rules('agama', 'agama', 'trim|required');
	$this->form_validation->set_rules('ktp', 'ktp', 'trim|required');
	$this->form_validation->set_rules('paspor', 'paspor', 'trim|required');
	$this->form_validation->set_rules('alamat_ktp', 'alamat ktp', 'trim|required');
	$this->form_validation->set_rules('alamat_akhir', 'alamat akhir', 'trim|required');
	$this->form_validation->set_rules('pangkat', 'pangkat', 'trim|required');
	$this->form_validation->set_rules('tmt_pangkat', 'tmt pangkat', 'trim|required');
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	$this->form_validation->set_rules('tmt_jabatan', 'tmt jabatan', 'trim|required');
	$this->form_validation->set_rules('masa_kerja', 'masa kerja', 'trim|required');
	$this->form_validation->set_rules('last_update', 'last update', 'trim|required');

	$this->form_validation->set_rules('uid', 'uid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "biodata.xls";
        $judul = "biodata";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nip");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Pob");
	xlsWriteLabel($tablehead, $kolomhead++, "Dob");
	xlsWriteLabel($tablehead, $kolomhead++, "Agama");
	xlsWriteLabel($tablehead, $kolomhead++, "Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "Paspor");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Ktp");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat Akhir");
	xlsWriteLabel($tablehead, $kolomhead++, "Pangkat");
	xlsWriteLabel($tablehead, $kolomhead++, "Tmt Pangkat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Tmt Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Masa Kerja");
	xlsWriteLabel($tablehead, $kolomhead++, "Last Update");

	foreach ($this->Biodata_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nip);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pob);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dob);
	    xlsWriteLabel($tablebody, $kolombody++, $data->agama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->paspor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_ktp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat_akhir);
	    xlsWriteLabel($tablebody, $kolombody++, $data->pangkat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tmt_pangkat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tmt_jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->masa_kerja);
	    xlsWriteLabel($tablebody, $kolombody++, $data->last_update);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=biodata.doc");

        $data = array(
            'biodata_data' => $this->Biodata_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('biodata/biodata_doc',$data);
    }

}

/* End of file Biodata.php */
/* Location: ./application/controllers/Biodata.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-09 01:13:06 */
/* http://harviacode.com */