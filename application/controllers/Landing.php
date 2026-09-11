<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index()
	{
		$rules = [['field' => 'pin', 'label' => 'PIN', 'rules' => 'required|trim|numeric']];
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == FALSE){
			$data['message'] = $this->session->flashdata('message');
			$this->load->view('template/landing_header');
			$this->load->view('landing/index', $data);
			$this->load->view('template/landing_footer');
        } else {
			$pin = $this->input->post('pin', TRUE);
			$pin = ['pin' => $pin];
			if($this->db->get_where('active_pin', $pin)->num_rows() != 1) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">PIN salah atau tidak valid!</div>');
                redirect('landing');
			} else {
				$data = ['pin' => $pin];
				$this->session->set_userdata($data);
				redirect('landing/voter');
			}
        }

	}

	public function voter()
	{
		if(!$this->session->userdata('pin')) {
			redirect('landing');
		} else {
			$pin = $this->session->userdata('pin');
			$data['voter'] = $this->db->get_where('voter', $pin)->result_array();
			$this->load->view('template/landing_header');
			$this->load->view('landing/voter', $data);
			$this->load->view('template/landing_footer');
		}
	}

	public function candidate()
	{
		if(!$this->session->userdata('pin')) {
			redirect('landing');
		} else {
			$rules = [['field' => 'vote', 'label' => 'Voter', 'rules' => 'required|trim']];
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == FALSE){
				$data['candidate'] = $this->db->get('candidate')->result_array();
				$this->load->view('template/landing_header');
				$this->load->view('landing/candidate', $data);
				$this->load->view('template/landing_footer');
			} else {
				$pin = $this->session->userdata('pin');
				$vote = $this->input->post('vote', TRUE);
				$status = $this->input->post('status', TRUE);
				$finish = $this->input->post('finish', TRUE);
				$data = [
					'status' => $status,
					'finished_at' => $finish
				];
				$this->db->query("UPDATE `candidate` SET `result` = result+1 WHERE `candidate`.`number` = $vote");
				$this->db->update('voter', $data, $pin);
				$this->db->delete('active_pin', $pin);
				redirect('landing/finish');
			}
		}
	}

	public function finish()
	{
		if(!$this->session->userdata('pin')) {
			redirect('landing');
		} else {
			$this->session->unset_userdata('pin');
			$this->load->view('template/landing_header');
			$this->load->view('landing/finish');
			$this->load->view('template/landing_footer');
		}
	}
}
