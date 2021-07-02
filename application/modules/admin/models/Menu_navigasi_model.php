<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_navigasi_model extends CI_Model
{
    // public function getAll()
    // {
    //     return $this->db->get('menu_navigasi')->result();
    // }

    public function getIndex()
    {
        return $this->db->order_by('no_urut ASC')->get_where('menu_navigasi', ['id_parent' => 0])->result();
    }

    public function getIndexSearch($q)
    {
        return $this->db->query("SELECT * FROM menu_navigasi WHERE id_parent = 0 AND (nama LIKE '%$q%' OR url LIKE '%$q%' OR icon LIKE '%$q%') ORDER BY no_urut ASC")->result();
    }

    public function getView($id)
    {
        return $this->db->order_by('no_urut ASC')->get_where('menu_navigasi', ['id_parent' => $id])->result();
    }

    public function getOne($id)
    {
        return $this->db->get_where('menu_navigasi', ['id_menu_navigasi' => $id])->row();
    }

    public function Add()
    {
        $no_urut = $this->db->where(['id_parent' => $this->input->post('id_parent')])->count_all_results('menu_navigasi');
        $no_urut++;

        $data = [
            'nama' => $this->input->post('nama'),
            'url' => $this->input->post('url'),
            'id_parent' => $this->input->post('id_parent'),
            'icon' => $this->input->post('icon'),
            'no_urut' => $no_urut,
            'status' => 1,
        ];
        $this->db->insert('menu_navigasi', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data menu navigasi berhasil ditambahkan! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }

    public function Update($id)
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'url' => $this->input->post('url'),
            'id_parent' => $this->input->post('id_parent'),
            'icon' => $this->input->post('icon'),
            'no_urut' => $this->input->post('no_urut'),
        ];
        $this->db->where('id_menu_navigasi', $id);
        $this->db->update('menu_navigasi', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data menu navigasi berhasil diupdate! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }

    public function Delete($id)
    {
        $this->db->delete('menu_navigasi', ['id_menu_navigasi' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data menu navigasi berhasil dihapus! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }
}
