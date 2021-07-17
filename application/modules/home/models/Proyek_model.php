<?php defined('BASEPATH') or exit('No direct script access allowed');

class Proyek_model extends CI_Model
{
    private $tabel = 'proyek';
    private function _post($postData)
    {
        return $this->input->post($postData);
    }

    public function getAll($status = null, $id_pemesan = null)
    {
        $this->db->select('proyek.*, tukang.nama as nama_tukang, pemesan.nama as nama_pemesan');
        $this->db->from($this->tabel);
        $this->db->join('tukang', 'tukang.id_tukang = proyek.id_tukang');
        $this->db->join('pemesan', 'pemesan.id_pemesan = proyek.id_pemesan');
        if ($status != null && $id_pemesan != null) {
            $this->db->where(['status' => $status, 'pemesan.id_pemesan' => $id_pemesan]);
            return $this->db->get()->result();
        } else if ($status != null) {
            $this->db->where(['status' => $status]);
            return $this->db->get()->result();
        } else if ($id_pemesan != null) {
            $this->db->where(['pemesan.id_pemesan' => $id_pemesan]);
            return $this->db->get()->result();
        }
        return $this->db->get()->result();
    }

    public function addToCart()
    {
        $url = $this->_post('url');
        $id_tukang = $this->_post('id_tukang');
        $id_pemesan = $this->_post('id_pemesan');
        $tanggal_awal = $this->_post('tanggal_awal');
        $tanggal_akhir = $this->_post('tanggal_akhir');
        $deskripsi = $this->_post('deskripsi');
        $lokasi = $this->_post('lokasi');
        $fee = $this->_post('fee');
        $data = [
            'jenis_proyek' => 0,
            'id_tukang' => $id_tukang,
            'id_pemesan' => $id_pemesan,
            'tanggal_awal' => $tanggal_awal,
            'tanggal_akhir' => $tanggal_akhir,
            'deskripsi' => $deskripsi,
            'lokasi' => $lokasi,
            'fee' => $fee,
            'status' => 1
        ];

        $this->db->insert($this->tabel, $data);
        redirect($url);
    }
}
