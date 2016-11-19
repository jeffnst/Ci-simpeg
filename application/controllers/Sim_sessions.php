<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sim_sessions extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Sim_sessions_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'sim_sessions/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'sim_sessions/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'sim_sessions/index.html';
            $config['first_url'] = base_url() . 'sim_sessions/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Sim_sessions_model->total_rows($q);
        $sim_sessions = $this->Sim_sessions_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'sim_sessions_data' => $sim_sessions,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->load->view('sim_sessions/sim_sessions_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Sim_sessions_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'ip_address' => $row->ip_address,
		'timestamp' => $row->timestamp,
		'data' => $row->data,
	    );
            $this->load->view('sim_sessions/sim_sessions_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sim_sessions'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('sim_sessions/create_action'),
	    'id' => set_value('id'),
	    'ip_address' => set_value('ip_address'),
	    'timestamp' => set_value('timestamp'),
	    'data' => set_value('data'),
	);
        $this->load->view('sim_sessions/sim_sessions_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'timestamp' => $this->input->post('timestamp',TRUE),
		'data' => $this->input->post('data',TRUE),
	    );

            $this->Sim_sessions_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('sim_sessions'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Sim_sessions_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('sim_sessions/update_action'),
		'id' => set_value('id', $row->id),
		'ip_address' => set_value('ip_address', $row->ip_address),
		'timestamp' => set_value('timestamp', $row->timestamp),
		'data' => set_value('data', $row->data),
	    );
            $this->load->view('sim_sessions/sim_sessions_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sim_sessions'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('', TRUE));
        } else {
            $data = array(
		'id' => $this->input->post('id',TRUE),
		'ip_address' => $this->input->post('ip_address',TRUE),
		'timestamp' => $this->input->post('timestamp',TRUE),
		'data' => $this->input->post('data',TRUE),
	    );

            $this->Sim_sessions_model->update($this->input->post('', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('sim_sessions'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Sim_sessions_model->get_by_id($id);

        if ($row) {
            $this->Sim_sessions_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('sim_sessions'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('sim_sessions'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('id', 'id', 'trim|required');
	$this->form_validation->set_rules('ip_address', 'ip address', 'trim|required');
	$this->form_validation->set_rules('timestamp', 'timestamp', 'trim|required');
	$this->form_validation->set_rules('data', 'data', 'trim|required');

	$this->form_validation->set_rules('', '', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "sim_sessions.xls";
        $judul = "sim_sessions";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Id");
	xlsWriteLabel($tablehead, $kolomhead++, "Ip Address");
	xlsWriteLabel($tablehead, $kolomhead++, "Timestamp");
	xlsWriteLabel($tablehead, $kolomhead++, "Data");

	foreach ($this->Sim_sessions_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->id);
	    xlsWriteLabel($tablebody, $kolombody++, $data->ip_address);
	    xlsWriteNumber($tablebody, $kolombody++, $data->timestamp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->data);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=sim_sessions.doc");

        $data = array(
            'sim_sessions_data' => $this->Sim_sessions_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('sim_sessions/sim_sessions_doc',$data);
    }

}

/* End of file Sim_sessions.php */
/* Location: ./application/controllers/Sim_sessions.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2016-11-09 01:13:06 */
/* http://harviacode.com */