<?php defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tukang_model');
        isLoginUser();
    }

    public function index()
    {
        if (!empty($_GET['q'])) {
            $tukangs = $this->Tukang_model->getBySearch($_GET['q']);
        } else {
            $tukangs = $this->Tukang_model->all();
        }
        __homeTemplate('search/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Cari Tukang',
            'tukangs' => $tukangs
        ]);
    }

    public function detail($id)
    {
        isLoginUser();

        $tukang = $this->Tukang_model->getById($id);
        __homeTemplate('home/detailTukang', [
            'title' => 'Dashboard',
            'tukang' => $tukang,
        ]);
    }
}
