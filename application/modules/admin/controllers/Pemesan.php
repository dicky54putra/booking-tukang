<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pemesan_model');
        is_logged_in();
    }

    public function index()
    {
        __adminTemplate('pemesan/index', [
            'title' => 'Data Pemesan',
            'data' => $this->Pemesan_model->getAll()
        ]);
    }

    public function view($id)
    {
        $pemesan = $this->Pemesan_model->getOne($id);
        $user = $this->db->get_where('user', ['id_user' => $pemesan->id_user])->row();
        $data = [
            'title' => 'Data Pemesan Detail',
            'data' => $pemesan,
            'user' => $user
        ];
        if (!empty($data['data'])) {
            __adminTemplate('pemesan/view', $data);
        } else {
            $this->load->view('auth/blocked');
        }
    }

    public function delete($id)
    {

        $this->db->trans_start();
        $this->Pemesan_model->Delete($id);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Koneksi terputus !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
            redirect('register');
        }
        redirect(__ADMIN . 'pemesan/index');
    }
}
