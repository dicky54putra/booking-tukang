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
        $carts = $this->Proyek_model->getAll(null, $user->id_pemesan);
        __homeTemplate('history/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Riwayat Pekerjaan',
            'carts' => $carts
        ]);
    }
}
