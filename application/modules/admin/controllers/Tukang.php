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
        $this->form_validation->set_rules('jk', 'jk', 'required');
        $this->form_validation->set_rules('fee_per_day', 'Fee/ Day', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required|is_unique[tukang.no_hp]');

        $object_data = (object)['jk' => ''];

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Data Tukang',
                'action' => base_url(__ADMIN . 'tukang/create'),
                'data' => $object_data
            ];
            __adminTemplate('tukang/create', $data);
        } else {
            $this->Tukang_model->Add();
            redirect(__ADMIN . 'tukang/index');
        }
    }

    public function update($id)
    {
        $data = [
            'title' => 'Tambah Data Tukang',
            'action' => base_url(__ADMIN . 'tukang/update/' . $id),
            'data' => $this->Tukang_model->getOne($id)
        ];

        if (!empty($data['data'])) {

            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('jk', 'jk', 'required');
            $this->form_validation->set_rules('fee_per_day', 'Fee/ Day', 'required');
            $this->form_validation->set_rules('no_hp', 'No HP', 'required');

            if ($this->form_validation->run() == false) {
                __adminTemplate('tukang/update', $data);
            } else {
                $this->Tukang_model->Update($id);
                redirect(__ADMIN . 'tukang/index');
            }
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
