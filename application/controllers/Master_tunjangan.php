<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Master_tunjangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Master_tunjangan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'master_tunjangan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'master_tunjangan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'master_tunjangan/index.html';
            $config['first_url'] = base_url() . 'master_tunjangan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Master_tunjangan_model->total_rows($q);
        $master_tunjangan = $this->Master_tunjangan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'master_tunjangan_data' => $master_tunjangan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('master_tunjangan/master_tunjangan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Master_tunjangan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_tunjangan' => $row->nama_tunjangan,
		'nominal' => $row->nominal,
	    );
            $this->load->view('master_tunjangan/master_tunjangan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_tunjangan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('master_tunjangan/create_action'),
	    'id' => set_value('id'),
	    'nama_tunjangan' => set_value('nama_tunjangan'),
	    'nominal' => set_value('nominal'),
	);
        $this->load->view('master_tunjangan/master_tunjangan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_tunjangan' => $this->input->post('nama_tunjangan',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
	    );

            $this->Master_tunjangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('master_tunjangan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Master_tunjangan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('master_tunjangan/update_action'),
		'id' => set_value('id', $row->id),
		'nama_tunjangan' => set_value('nama_tunjangan', $row->nama_tunjangan),
		'nominal' => set_value('nominal', $row->nominal),
	    );
            $this->load->view('master_tunjangan/master_tunjangan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_tunjangan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_tunjangan' => $this->input->post('nama_tunjangan',TRUE),
		'nominal' => $this->input->post('nominal',TRUE),
	    );

            $this->Master_tunjangan_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('master_tunjangan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Master_tunjangan_model->get_by_id($id);

        if ($row) {
            $this->Master_tunjangan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('master_tunjangan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('master_tunjangan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_tunjangan', 'nama tunjangan', 'trim|required');
	$this->form_validation->set_rules('nominal', 'nominal', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "master_tunjangan.xls";
        $judul = "master_tunjangan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Tunjangan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nominal");

	foreach ($this->Master_tunjangan_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_tunjangan);
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
        header("Content-Disposition: attachment;Filename=master_tunjangan.doc");

        $data = array(
            'master_tunjangan_data' => $this->Master_tunjangan_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('master_tunjangan/master_tunjangan_doc',$data);
    }

}

/* End of file Master_tunjangan.php */
/* Location: ./application/controllers/Master_tunjangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-09 01:13:06 */
/* http://harviacode.com */