<?php defined('BASEPATH') or exit('No direct script access allowed');

class Proyek_model extends CI_Model
{
    private $tabel = 'proyek';
    private function _post($postData)
    {
        return $this->input->post($postData);
    }

    private function _query()
    {
        $this->db->select('proyek.*, tukang.nama as nama_tukang, pemesan.nama as nama_pemesan');
        $this->db->from($this->tabel);
        $this->db->join('tukang', 'tukang.id_tukang = proyek.id_tukang');
        $this->db->join('pemesan', 'pemesan.id_pemesan = proyek.id_pemesan');
    }

    public function getAll($status = null, $id_pemesan = null)
    {
        $this->_query();
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

    public function getOne($id)
    {
        return $this->db->get_where($this->tabel, ['id_proyek' => $id])->row();
    }

    public function updateSkor($id)
    {
        $this->db->where(['id_proyek' => $id]);
        $this->db->update($this->tabel, ['skor' => $this->input->post('nilai')]);
        return true;
    }

    public function getSearch()
    {
        $tanggal_awal = $this->_post('tanggal_awal');
        $tanggal_akhir = $this->_post('tanggal_akhir');
        $deskripsi = $this->_post('deskripsi');
        $lokasi = $this->_post('lokasi');
        $fee = $this->_post('fee');
        $status = $this->_post('status');

        $whereTanggaAwal = !empty($tanggal_awal) ? "AND tanggal_awal = '$tanggal_awal'" : '';
        $whereTanggaAkhir = !empty($tanggal_akhir) ? "AND tanggal_akhir = '$tanggal_akhir'" : '';
        $whereDeskripsi = !empty($deskripsi) ? "AND deskripsi LIKE '%{$deskripsi}%'" : '';
        $whereLokasi = !empty($lokasi) ? "AND lokasi LIKE '%{$lokasi}%'" : '';
        $whereFee = !empty($fee) ? "AND fee LIKE '%{$fee}%'" : '';
        $whereStatus = !empty($status) ? "AND fee = '{$status}'" : '';

        $this->db->where("1 {$whereTanggaAwal} {$whereTanggaAkhir} {$whereDeskripsi} {$whereLokasi} {$whereFee} {$whereStatus}");
        $this->_query();
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
        redirect('history');
    }

    public function updateStatus($id = [], $status)
    {
        $this->db->trans_start();
        for ($i = 0; $i < count($id); $i++) {
            $this->db->where('id_proyek', $id[$i]);
            $this->db->update('proyek', ['status' => $status]);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Koneksi terputus !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
            redirect('profile/cart');
        }
        return true;
    }
}
