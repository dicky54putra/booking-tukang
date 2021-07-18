<?php defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proyek_model');
        isLoginUser();
    }

    public function index()
    {
        $user = get_user_tabel();
        if (!$this->input->post()) {
            $carts = $this->Proyek_model->getAll(null, $user->id_pemesan);
        } else {
            $carts = $this->Proyek_model->getSearch();
        }
        $post = $this->input->post();
        __homeTemplate('history/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Riwayat Pekerjaan',
            'carts' => $carts,
            'post' => $post,
        ]);
    }
}
