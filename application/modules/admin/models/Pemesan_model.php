<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesan_model extends CI_Model
{
    private $tabel = 'pemesan';
    public function getAll()
    {
        return $this->db->get($this->tabel)->result();
    }

    public function getOne($id)
    {
        return $this->db->get_where($this->tabel, ['id_' . $this->tabel => $id])->row();
    }

    public function Delete($id)
    {
        $data = $this->getOne($id);
        $user = $this->db->get_where('user', ['id_user' => $data->id_user]);
        if ($user) {
            $this->db->delete('user', ['id_user' => $data->id_user]);
        }
        $this->db->delete($this->table, ['id_' . $this->table => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data tukang berhasil dihapus! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }
}
