<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_gapok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_gapok_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'master_gapok/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'master_gapok/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'master_gapok/index.html';
            $config['first_url'] = base_url() . 'master_gapok/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Master_gapok_model->total_rows($q);
        $master_gapok = $this->Master_gapok_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'master_gapok_data' => $master_gapok,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('master_gapok/master_gapok_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Master_gapok_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'golongan' => $row->golongan,
		'masa_kerja' => $row->masa_kerja,
		'nominal' => $row->nominal,
	    );
            $this->load->view('master_gapok/master_gapok_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_gapok'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master_gapok/create_action'),
	    'id' => set_value('id'),
	    'golongan' => set_value('golongan'),
	    'masa_kerja' => set_value('masa_kerja'),
	    'nominal' => set_value('nominal'),
	);
        $this->load->view('master_gapok/master_gapok_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'golongan' => $this->input->post('golongan',TRUE),
		'masa_kerja' => $this->input->post('masa_kerja',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
	    );

            $this->Master_gapok_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_gapok'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_gapok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master_gapok/update_action'),
		'id' => set_value('id', $row->id),
		'golongan' => set_value('golongan', $row->golongan),
		'masa_kerja' => set_value('masa_kerja', $row->masa_kerja),
		'nominal' => set_value('nominal', $row->nominal),
	    );
            $this->load->view('master_gapok/master_gapok_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_gapok'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'golongan' => $this->input->post('golongan',TRUE),
		'masa_kerja' => $this->input->post('masa_kerja',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
	    );

            $this->Master_gapok_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_gapok'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_gapok_model->get_by_id($id);

        if ($row) {
            $this->Master_gapok_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_gapok'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_gapok'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('golongan', 'golongan', 'trim|required');
	$this->form_validation->set_rules('masa_kerja', 'masa kerja', 'trim|required');
	$this->form_validation->set_rules('nominal', 'nominal', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_gapok.xls";
        $judul = "master_gapok";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Golongan");
	xlsWriteLabel($tablehead, $kolomhead++, "Masa Kerja");
	xlsWriteLabel($tablehead, $kolomhead++, "Nominal");

	foreach ($this->Master_gapok_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->golongan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->masa_kerja);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nominal);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=master_gapok.doc");

        $data = array(
            'master_gapok_data' => $this->Master_gapok_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('master_gapok/master_gapok_doc',$data);
    }

}

/* End of file Master_gapok.php */
/* Location: ./application/controllers/Master_gapok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-09 01:13:06 */
/* http://harviacode.com */