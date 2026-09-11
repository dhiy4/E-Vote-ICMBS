<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function index()
    {
        $rules = [
            ['field' => 'username', 'label' => 'Username', 'rules' => 'required|trim'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required|trim']
        ];
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == FALSE){
            $auth = $this->session->userdata('username');
            if(isset($auth)) {
                redirect('dashboard');
            }
            $data['title'] = 'Login Page';
            $data['message'] = $this->session->flashdata('message');
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('template/auth_footer');
        } else {
            $this->_login();
        }
    }
    
    public function registration()
    {
        $rules = [
            ['field' => 'username', 'label' => 'Username', 'rules' => 'required|trim|is_unique[admin.username]'],
            ['field' => 'password', 'label' => 'Password', 'rules' => 'required|trim|min_length[8]'],
            ['field' => 'password_rpt', 'label' => 'Password', 'rules' => 'required|trim|min_length[8]|matches[password]']
        ];
        $this->form_validation->set_rules($rules);
        if($this->form_validation->run() == FALSE){
            $data['title'] = 'Registration Page';
            $data['message'] = $this->session->flashdata('message');
            $this->load->view('template/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('template/auth_footer');
        } else {
            $this->_register();
        }
    }
    
    private function _register()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE));
        $password = password_hash($this->input->post('password', TRUE), PASSWORD_DEFAULT);
        $data = [
            'username' => $username,
            'password' => $password
        ];
        $result = $this->db->insert('admin', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Registration success, please login!</div>');
        redirect('auth');
    }
    
    private function _login()
    {
        $username = htmlspecialchars($this->input->post('username', TRUE));
        $password = htmlspecialchars($this->input->post('password', TRUE));
        $data = ['username' => $username];
        $user = $this->db->get_where('admin', $data)->row_array();
        
        if ($user != NULL) {
            if (password_verify($password, $user['password'])) {
                $data = ['username' => $user['username']];
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
                redirect('auth');
            }
           
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        if(!$this->session->userdata('username')) {
            show_404();
        } else {
            $data = ['username'];
            $this->session->unset_userdata($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logout!</div>');
            redirect('auth');
        }
    }
}