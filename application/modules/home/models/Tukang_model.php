<?php defined('BASEPATH') or exit('No direct script access allowed');

class Tukang_model extends CI_Model
{
    private $tabel = 'tukang';
    public function all($limit = null)
    {
        if ($limit != null) {
            return $this->db->get($this->tabel, $limit)->result();
        } else {
            return $this->db->get($this->tabel)->result();
        }
    }

    public function getById($id)
    {
        return $this->db->get($this->tabel, ['id_tukang' => $id])->row();
    }

    public function getBySearch($param)
    {
        return $this->db->get_where($this->tabel, "nama LIKE '%{$param}%' OR alamat LIKE '%{$param}%' OR tanggal_lahir LIKE '%{$param}%' OR no_hp LIKE '%{$param}%' OR fee_per_day LIKE '%{$param}%' OR skills LIKE '%{$param}%'")->result();
    }
}
