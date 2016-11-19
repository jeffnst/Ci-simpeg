<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_jabatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_jabatan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'master_jabatan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'master_jabatan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'master_jabatan/index.html';
            $config['first_url'] = base_url() . 'master_jabatan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Master_jabatan_model->total_rows($q);
        $master_jabatan = $this->Master_jabatan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'master_jabatan_data' => $master_jabatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('master_jabatan/master_jabatan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Master_jabatan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_jabatan' => $row->nama_jabatan,
		'jenis_jabatan' => $row->jenis_jabatan,
	    );
            $this->load->view('master_jabatan/master_jabatan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_jabatan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master_jabatan/create_action'),
	    'id' => set_value('id'),
	    'nama_jabatan' => set_value('nama_jabatan'),
	    'jenis_jabatan' => set_value('jenis_jabatan'),
	);
        $this->load->view('master_jabatan/master_jabatan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
		'jenis_jabatan' => $this->input->post('jenis_jabatan',TRUE),
	    );

            $this->Master_jabatan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_jabatan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_jabatan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master_jabatan/update_action'),
		'id' => set_value('id', $row->id),
		'nama_jabatan' => set_value('nama_jabatan', $row->nama_jabatan),
		'jenis_jabatan' => set_value('jenis_jabatan', $row->jenis_jabatan),
	    );
            $this->load->view('master_jabatan/master_jabatan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_jabatan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_jabatan' => $this->input->post('nama_jabatan',TRUE),
		'jenis_jabatan' => $this->input->post('jenis_jabatan',TRUE),
	    );

            $this->Master_jabatan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_jabatan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_jabatan_model->get_by_id($id);

        if ($row) {
            $this->Master_jabatan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_jabatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_jabatan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_jabatan', 'nama jabatan', 'trim|required');
	$this->form_validation->set_rules('jenis_jabatan', 'jenis jabatan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_jabatan.xls";
        $judul = "master_jabatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Jabatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Jabatan");

	foreach ($this->Master_jabatan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_jabatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_jabatan);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=master_jabatan.doc");

        $data = array(
            'master_jabatan_data' => $this->Master_jabatan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('master_jabatan/master_jabatan_doc',$data);
    }

}

/* End of file Master_jabatan.php */
/* Location: ./application/controllers/Master_jabatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-09 01:13:06 */
/* http://harviacode.com */