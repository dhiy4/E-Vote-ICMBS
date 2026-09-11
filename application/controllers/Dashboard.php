<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pdf');
        if(!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Akses ditolak!</div>');
            redirect('auth');
        }

    }

    public function index()
    {
        $data['student'] = $this->db->get_where('voter', ['information' => "SISWA"])->num_rows();
        $data['teacher'] = $this->db->get_where('voter', ['information' => "GURU"])->num_rows();
        $data['inactive'] = $this->db->get_where('voter', ['status' => "ACTIVE"])->num_rows();
        $data['finish'] = $this->db->get_where('voter', ['status' => "FINISH"])->num_rows();
        $data['user'] = ucwords($this->session->userdata['username']);
        $data['title'] = 'Menu Utama';
        $this->load->view('template/dashboard_header', $data);
        $this->load->view('template/dashboard_sidebar');
        $this->load->view('template/dashboard_navbar', $data);
		$this->load->view('dashboard/index', $data);
		$this->load->view('template/dashboard_footer');
    }

    private function _generatePIN() {
        $i = 0; //counter
        $pin = ""; //our default pin is blank.
        while($i < 6){
            //generate a random number between 0 and 9.
            $pin .= mt_rand(1, 9);
            $i++;
        }
        return $pin;
    }

    public function voter()
    {
        $rules = [['field' => 'name', 'label' => 'Name', 'rules' => 'required|trim']];
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == FALSE){
            $data['message'] = $this->session->flashdata('message');
            $data['pin'] = $this->_generatePIN();
            $data['voter'] = $this->db->get('voter')->result_array();
            $data['user'] = ucwords($this->session->userdata['username']);
            $data['title'] = 'Data Pemilih';
            $this->load->view('template/dashboard_header', $data);
            $this->load->view('template/dashboard_sidebar');
            $this->load->view('template/dashboard_navbar', $data);
            $this->load->view('dashboard/voter', $data);
            $this->load->view('template/dashboard_footer');
        } else {
            $name = $this->input->post('name', TRUE);
            $name = ucwords(strtolower($name));
            $information = $this->input->post('information', TRUE);
            $pin = $this->input->post('pin', TRUE);
            $data = [
                'name' => $name,
                'information' => $information,
                'pin' => $pin,
                'status' => 'INACTIVE'
            ];
            $this->db->insert('voter', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah pemilih berhasil!</div>');
            redirect('dashboard/voter');
        }
    }

    public function activePIN()
    {
        $rules = [['field' => 'status', 'label' => 'Status', 'rules' => 'required|trim']];
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Aktivasi PIN gagal!</div>');
            redirect('dashboard/voter');
        } else {
            $id = $this->input->post('id', TRUE);
            $pin = $this->input->post('pin', TRUE);
            $status = $this->input->post('status', TRUE);
            $active = $this->input->post('active', TRUE);
            $data = [
                'status' => $status,
                'actived_at' => $active
            ];
            $pin = ['pin' => $pin];
            $this->db->update('voter', $data, ['id' => $id]);
            $this->db->insert('active_pin', $pin);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Aktivasi PIN berhasil!</div>');
            redirect('dashboard/voter');
        }

    }

    public function print()
    {
        $pdf = new FPDF('P','mm','A4');
        $pdf->SetTitle('Cetak Data Pemilih');
        $pdf->SetMargins(5, 5, 5);
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(100, 6, 'Nama', 1, 0, 'C');
        $pdf->Cell(50, 6, 'Keterangan', 1, 0, 'C');
        $pdf->Cell(50, 6, 'PIN', 1, 1, "C" );
        $pdf->SetFont('Arial','',10);
        $voter = $this->db->get('voter')->result_array();
        foreach ($voter as $voter){
            $pdf->Cell(100, 10, $voter['name'], 1, 0);
            $pdf->Cell(50, 10, $voter['information'], 1, 0, 'C');
            $pdf->Cell(50, 10, $voter['pin'], 1, 1, 'C');
        }
        $pdf->Output('I', 'Data_Pemilih.pdf', TRUE);
    }


    private function _upload($number)
    {
            $number = $number;
            $config['upload_path'] = './assets/img/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_size'] = 8192;
            $config['max_width'] = 6000;
            $config['max_height'] = 4000;
            $config['file_name'] = 'IMG_'.$number;
            $config['overwrite'] = TRUE;

            $data = $this->upload->initialize($config);
            if ($this->upload->do_upload('photo')) {
                $data = $this->upload->data();
                return $data['file_name'];
            } else {
                return $this->upload->display_errors();
            }
    }

    public function candidate()
    {
        $rules = [
            ['field' => 'number', 'label' => 'Number', 'rules' => 'required|trim'],
            ['field' => 'name1', 'label' => 'Name1', 'rules' => 'required|trim'],
            ['field' => 'name2', 'label' => 'Name2', 'rules' => 'required|trim']
        ];
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == FALSE){
            $data['message'] = $this->session->flashdata('message');
            $data['candidate'] = $this->db->get('candidate')->result_array();
            $data['user'] = ucwords($this->session->userdata['username']);
            $data['title'] = 'Data Kandidat';
            $this->load->view('template/dashboard_header', $data);
            $this->load->view('template/dashboard_sidebar');
            $this->load->view('template/dashboard_navbar', $data);
            $this->load->view('dashboard/candidate', $data);
            $this->load->view('template/dashboard_footer');
        } else {
            $number = $this->input->post('number', TRUE);
            $name1 = $this->input->post('name1', TRUE);
            $name1 = ucwords(strtolower($name1));
            $name2 = $this->input->post('name2', TRUE);
            $name2 = ucwords(strtolower($name2));
            $photo = $this->_upload($number);
            $data = [
                'number' => $number,
                'name1' => $name1,
                'name2' => $name2,
                'photo' => $photo
            ];
            $this->db->insert('candidate', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Tambah kandidat berhasil!</div>');
            redirect('dashboard/candidate');
        }
    }

    public function result()
    {
        $data['message'] = $this->session->flashdata('message');
        $data['candidate'] = $this->db->get('candidate')->result_array();
        $data['user'] = ucwords($this->session->userdata['username']);
        $data['title'] = 'Hasil Voting';
        $this->load->view('template/dashboard_header', $data);
        $this->load->view('template/dashboard_sidebar');
        $this->load->view('template/dashboard_navbar', $data);
        $this->load->view('dashboard/result', $data);
        $this->load->view('template/dashboard_footer');
    }

    public function delete($number, $photo)
    {
        if($number == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Hapus kandidat gagal!</div>');
            redirect('dashboard/candidate');
        } else {
            $this->db->delete('candidate', ['number' => $number]);
            unlink('./assets/img/' . $photo);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Hapus kandidat berhasil!</div>');
            redirect('dashboard/candidate');
        }
    }

    public function setting()
    {
        $data['user'] = ucwords($this->session->userdata['username']);
        $data['title'] = 'Pengaturan Profil';
        $this->load->view('template/dashboard_header', $data);
        $this->load->view('template/dashboard_sidebar');
        $this->load->view('template/dashboard_navbar', $data);
        $this->load->view('dashboard/setting', $data);
        $this->load->view('template/dashboard_footer');
    }

}
