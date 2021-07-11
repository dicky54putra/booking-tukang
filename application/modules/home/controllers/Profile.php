<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginUser();
    }

    public function index()
    {
        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
        __homeTemplate('profile/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Profile Tukang',
            'user' => $user
        ]);
    }

    public function cart()
    {
        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
        echo 'ok';
        __homeTemplate('profile/cart', [
            'title' => 'Dashboard',
            'titleApp' => 'Cart Tukang',
            'user' => $user
        ]);
    }
}
