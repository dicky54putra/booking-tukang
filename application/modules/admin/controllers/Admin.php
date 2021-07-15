<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        is_logged_in();
        $data = [
            'title' => 'Dahshboard',
        ];
        $this->load->view('template/header', $data);
        $this->load->view('auth/index', $data);
        $this->load->view('template/footer');
    }

    public function login()
    {
        if ($this->session->userdata('login') == 'login') {
            redirect('admin');
        }
        $data = [
            'title' => 'Login',
        ];

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/login_header', $data);
            $this->load->view('auth/login', $data);
            $this->load->view('template/login_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row();

        if (!empty($user)) {
            if (password_verify($password, $user->password)) {
                $data = [
                    'id_user' => $user->id_user,
                    'username' => $user->username,
                    'id_role' => $user->role,
                    'login' => 'login',
                ];
                $this->session->set_userdata($data);
                // redirect($this->input->post('url'));
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Username atau Password salah!, silahkan periksa username dan password anda kembali !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                redirect('admin/login');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Username atau password salah!, silahkan periksa username dan password anda kembali !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
            redirect('admin/login');
        }
    }

    public function logout()
    {
        // is_logged_in();
        $data = [
            'username' => 'username',
            'role' => 'role',
            'login' => 'login',
        ];
        $this->session->unset_userdata($data);

        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Berhasil</h5>Logout!<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
        redirect('admin/login');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    public function profil()
    {
        $id = $this->session->userdata('id_user');
        $model = $this->db->get_where('user', ['id_user' => $id])->row();
        $username_is_unique = ($model->username != $this->input->post('username')) ? '|is_unique[user.username]' : '';
        $this->form_validation->set_rules('username', 'Username', 'trim' . $username_is_unique);

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Profil User',
                'data' => $this->User_model->getOne($id),
            ];
            $this->load->view('template/header', $data);
            $this->load->view('auth/profil', $data);
            $this->load->view('template/footer');
        } else {
            $this->User_model->Update($id);
            redirect("admin/profil/$id");
        }
    }

    public function change_password($id)
    {
        $password_old = $this->input->post('password_old');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password_repeat', 'Password Repeat', 'trim|required|matches[password]');
        $cek = $this->db->get_where('user', ['id_user' => $id])->row();
        if (password_verify($password_old, $cek->password)) {
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message_change_password', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Password dan password repeat tidak sama, anda tidak bisa mengubah password!<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                redirect("admin/profil/$id");
            } else {
                $this->db->where('id_user', $id);
                $this->db->update('user', ['password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)]);
                $data = [
                    'username' => 'username',
                    'role' => 'role',
                    'login' => 'login',
                ];
                $this->session->unset_userdata($data);

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Password berhasil diupdate! Silahkan login kembali<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                redirect('admin/login');
            }
        } else {
            $this->session->set_flashdata('message_change_password', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Password lama salah, anda tidak bisa mengubah password!<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
            redirect("admin/profil/$id");
        }
    }
}
