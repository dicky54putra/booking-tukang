<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proyek_model extends CI_Model
{
    private $tabel = 'proyek';
    public function getAll()
    {
        $this->db->select("{$this->tabel}.*, pemesan.nama as nama_pemesan, tukang.nama as nama_tukang");
        // $this->db->where(["{$this->tabel}.status >" => 1]);
        $this->db->order_by('id_proyek', 'DESC');
        $query = $this->db->join('pemesan', "pemesan.id_pemesan = {$this->tabel}.id_pemesan", "left")->join('tukang', "tukang.id_tukang = {$this->tabel}.id_tukang", "left")->get($this->tabel)->result();
        return $query;
    }

    public function getOne($id)
    {
        return $this->db->get_where($this->tabel, ['id_' . $this->tabel => $id])->row();
    }

    public function updateStatus($id, $status)
    {
        $this->db->where(['id_proyek' => $id]);
        $this->db->update($this->tabel, ['status' => $status]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data proyek berhasil diupdate! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }

    public function Delete($id)
    {
        $data = $this->getOne($id);
        $user = $this->db->get_where('user', ['id_user' => $data->id_user]);
        if ($user) {
            $this->db->delete('user', ['id_user' => $data->id_user]);
        }
        $this->db->delete($this->table, ['id_' . $this->table => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data proyek berhasil dihapus! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }
}
