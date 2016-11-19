<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_biro extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_biro_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'master_biro/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'master_biro/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'master_biro/index.html';
            $config['first_url'] = base_url() . 'master_biro/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Master_biro_model->total_rows($q);
        $master_biro = $this->Master_biro_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'master_biro_data' => $master_biro,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('master_biro/master_biro_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Master_biro_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_biro' => $row->nama_biro,
	    );
            $this->load->view('master_biro/master_biro_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_biro'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master_biro/create_action'),
	    'id' => set_value('id'),
	    'nama_biro' => set_value('nama_biro'),
	);
        $this->load->view('master_biro/master_biro_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_biro' => $this->input->post('nama_biro',TRUE),
	    );

            $this->Master_biro_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_biro'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_biro_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master_biro/update_action'),
		'id' => set_value('id', $row->id),
		'nama_biro' => set_value('nama_biro', $row->nama_biro),
	    );
            $this->load->view('master_biro/master_biro_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_biro'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_biro' => $this->input->post('nama_biro',TRUE),
	    );

            $this->Master_biro_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_biro'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_biro_model->get_by_id($id);

        if ($row) {
            $this->Master_biro_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_biro'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_biro'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_biro', 'nama biro', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_biro.xls";
        $judul = "master_biro";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Biro");

	foreach ($this->Master_biro_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_biro);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=master_biro.doc");

        $data = array(
            'master_biro_data' => $this->Master_biro_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('master_biro/master_biro_doc',$data);
    }

}

/* End of file Master_biro.php */
/* Location: ./application/controllers/Master_biro.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-09 01:13:06 */
/* http://harviacode.com */