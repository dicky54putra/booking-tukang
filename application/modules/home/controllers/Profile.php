<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pemesan_model');
        $this->load->model('Home_model');
        $this->load->model('Proyek_model');
        isLoginUser();
    }

    public function index()
    {
        $session = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row();
        $pemesan = $this->db->get_where('pemesan', ['id_user' => $session->id_user])->row();
        $tukang = $this->db->get_where('pemesan', ['id_user' => $session->id_user])->row();

        $user = (!empty($pemesan)) ? $pemesan : $pm = (!empty($pemesan)) ? $tukang : $session;

        __homeTemplate('profile/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Profile ',
            'user' => $user,
            'session' => $session
        ]);
    }

    public function cart()
    {
        $user = get_user_tabel();
        $carts = $this->Proyek_model->getAll(1, $user->id_pemesan);

        __homeTemplate('profile/cart', [
            'title' => 'Dashboard',
            'titleApp' => 'Cart Tukang',
            'user' => $user,
            'carts' => $carts,
        ]);
    }

    public function edit()
    {
        $data = $this->db->get_where('pemesan', ['id_user' => $this->session->userdata('id_user')])->row();

        $post = $this->input->post();
        if ($post) {
            $this->Pemesan_model->edit($data->id_pemesan);
            redirect('profile');
        }

        __homeTemplate('profile/editProfile', [
            'title' => 'Dashboard',
            'titleApp' => 'Ubah Profile',
            'data' => $data
        ]);
    }

    public function editAkun()
    {
        $data = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row();
        $pemesan = $this->db->get_where('pemesan', ['id_user' => $this->session->userdata('id_user')])->row();

        $post = $this->input->post();
        if ($post) {
            $this->Home_model->editAkun($data->id_user);
            redirect('profile');
        }

        __homeTemplate('profile/editAkun', [
            'title' => 'Dashboard',
            'titleApp' => 'Ubah Profile',
            'data' => $data
        ]);
    }
}
