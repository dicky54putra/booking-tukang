<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proyek_model');
        is_logged_in();
    }

    public function index()
    {
        __adminTemplate('proyek/index', [
            'title' => 'Data Proyek',
            'data' => $this->Proyek_model->getAll()
        ]);
    }

    public function view($id)
    {
        $Proyek = $this->Proyek_model->getOne($id);
        $user = $this->db->get_where('user', ['id_user' => $Proyek->id_user])->row();
        $data = [
            'title' => 'Data Proyek Detail',
            'data' => $Proyek,
            'user' => $user
        ];
        if (!empty($data['data'])) {
            __adminTemplate('proyek/view', $data);
        } else {
            $this->load->view('auth/blocked');
        }
    }

    public function update_selesai($id)
    {
        $this->Proyek_model->updateStatus($id, 3);
        redirect(__ADMIN . 'proyek');
    }

    public function update_proses($id)
    {
        $this->Proyek_model->updateStatus($id, 2);
        redirect(__ADMIN . 'proyek');
    }

    public function update_canceled($id)
    {
        $this->Proyek_model->updateStatus($id, 0);
        redirect(__ADMIN . 'proyek');
    }

    public function delete($id)
    {

        $this->db->trans_start();
        $this->Proyek_model->Delete($id);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Koneksi terputus !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
            redirect('register');
        }
        redirect(__ADMIN . 'proyek/index');
    }
}
