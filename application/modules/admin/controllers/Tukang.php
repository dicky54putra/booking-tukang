<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tukang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tukang_model');
        is_logged_in();
    }

    public function index()
    {
        __adminTemplate('tukang/index', [
            'title' => 'Data Tukang',
            'data' => $this->Tukang_model->getAll()
        ]);
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nis', 'Nis', 'required|is_unique[tukang.email]');
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tukang.email]');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Data Tukang',
                'action' => base_url('tukang/create')
            ];
            __adminTemplate('tukang/create', $data);
        } else {
            $this->Tukang_model->Add();
            redirect('tukang/index');
        }
    }

    public function view($id)
    {
        $data = [
            'title' => 'Data Tukang Detail',
            'data' => $this->Tukang_model->getOne($id)
        ];
        if (!empty($data['data'])) {
            __adminTemplate('tukang/view', $data);
        } else {
            $this->load->view('auth/blocked');
        }
    }

    public function delete($id)
    {
        $this->db->trans_start();
        $this->Tukang_model->Delete($id);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Koneksi terputus !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
            redirect('register');
        }
        redirect(__ADMIN . 'tukang/index');
    }
}
