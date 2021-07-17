<?php defined('BASEPATH') or exit('No direct script access allowed');

class Pemesan_model extends CI_Model
{
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
        return $this->db->get_where($this->tabel, ['id_' . $this->tabel => $id])->row();
    }

    public function add($nama, $email, $no_hp, $alamat, $id_user, $jk = NULL)
    {
        return $this->db->insert('pemesan', [
            'nama' => $nama,
            'email' => $email,
            'no_hp' => $no_hp,
            'alamat' => $alamat,
            'jk' => $jk,
            'id_user' => $id_user,
        ]);
    }

    public function edit($id)
    {
        $pemesan = $this->db->get_where('pemesan', ['id_pemesan' => $id])->row();
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'alamat' => $this->input->post('alamat'),
            'jk' => $this->input->post('jk'),
        ];

        $this->db->trans_start();
        $this->db->update('user', ['nama' => $this->input->post('nama')], ['id_user' => $pemesan->id_user]);
        $this->db->update('pemesan', $data, ['id_pemesan' => $id]);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Koneksi terputus !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
            redirect('profile/edit');
        }
        return true;
    }
}
