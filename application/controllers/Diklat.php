<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Diklat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Diklat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'diklat/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'diklat/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'diklat/index.html';
            $config['first_url'] = base_url() . 'diklat/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Diklat_model->total_rows($q);
        $diklat = $this->Diklat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'diklat_data' => $diklat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('diklat/diklat_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Diklat_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama_diklat' => $row->nama_diklat,
		'jenis' => $row->jenis,
		'tahun' => $row->tahun,
	    );
            $this->load->view('diklat/diklat_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('diklat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('diklat/create_action'),
	    'id' => set_value('id'),
	    'nama_diklat' => set_value('nama_diklat'),
	    'jenis' => set_value('jenis'),
	    'tahun' => set_value('tahun'),
	);
        $this->load->view('diklat/diklat_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_diklat' => $this->input->post('nama_diklat',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
	    );

            $this->Diklat_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('diklat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Diklat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('diklat/update_action'),
		'id' => set_value('id', $row->id),
		'nama_diklat' => set_value('nama_diklat', $row->nama_diklat),
		'jenis' => set_value('jenis', $row->jenis),
		'tahun' => set_value('tahun', $row->tahun),
	    );
            $this->load->view('diklat/diklat_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('diklat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama_diklat' => $this->input->post('nama_diklat',TRUE),
		'jenis' => $this->input->post('jenis',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
	    );

            $this->Diklat_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('diklat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Diklat_model->get_by_id($id);

        if ($row) {
            $this->Diklat_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('diklat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('diklat'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_diklat', 'nama diklat', 'trim|required');
	$this->form_validation->set_rules('jenis', 'jenis', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "diklat.xls";
        $judul = "diklat";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Diklat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun");

	foreach ($this->Diklat_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_diklat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tahun);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=diklat.doc");

        $data = array(
            'diklat_data' => $this->Diklat_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('diklat/diklat_doc',$data);
    }

}

/* End of file Diklat.php */
/* Location: ./application/controllers/Diklat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-09 01:13:06 */
/* http://harviacode.com */