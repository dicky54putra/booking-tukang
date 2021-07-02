<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        is_logged_in();
    }

    public function index()
    {
        $data = [
            'title' => 'Data User',
            'data' => $this->User_model->getAll()
        ];
        $this->load->view('template/header', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/footer');
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password_repeat', 'Password Repeat', 'trim|required|matches[password]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Data User',
                'action' => base_url('user/create')
            ];
            $this->load->view('template/header', $data);
            $this->load->view('user/create', $data);
            $this->load->view('template/footer');
        } else {
            $this->User_model->Add();
            redirect('user/index');
        }
    }

    public function update($id)
    {
        $data = [
            'title' => 'Ubah Data User',
            'data' => $this->User_model->getOne($id),
            'action' => base_url('user/update/') . $id
        ];
        if (!empty($data['data'])) {
            $model = $this->db->get_where('user', ['id_user' => $id])->row();
            $username_is_unique = ($model->username != $this->input->post('username')) ? '|is_unique[user.username]' : '';
            $required = ($model->role == 1) ? '|required' : '';
            $this->form_validation->set_rules('nama', 'Nama', 'trim' . $required);
            $this->form_validation->set_rules('username', 'Username', 'trim' . $required . '' . $username_is_unique);
            $this->form_validation->set_rules('password', 'Password', 'trim' . $required . '|min_length[3]');
            $this->form_validation->set_rules('password_repeat', 'Password Repeat', 'trim' . $required . '|matches[password]');
            $this->form_validation->set_rules('role', 'Role',  'trim' . $required);

            if ($this->form_validation->run() == false) {
                $this->load->view('template/header', $data);
                $this->load->view('user/update', $data);
                $this->load->view('template/footer');
            } else {
                $this->User_model->Update($id);
                redirect('user/index');
            }
        } else {
            $this->load->view('auth/blocked');
        }
    }

    public function delete($id)
    {
        $this->User_model->Delete($id);
        redirect('user/index');
    }
}
