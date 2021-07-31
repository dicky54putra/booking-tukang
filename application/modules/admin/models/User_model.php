<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function getAll()
    {
        return $this->db->get_where('user', ['role' => 1])->result();
    }

    public function getOne($id)
    {
        return $this->db->get_where('user', ['id_user' => $id])->row();
    }

    public function Add()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role' => $this->input->post('role'),
        ];

        $config['upload_path']          = './upload/user/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = date('Y/m/d/h/i') . '-' . $data['username'];
        $config['overwrite']            = true;

        $this->load->library('upload', $config);
        if (!empty($_FILES['foto']['name'])) {
            if ($this->upload->do_upload('foto')) {
                $file_name = $this->upload->data("file_name");
                $data['foto'] = $file_name;
            } else {
                $data['foto'] = "format file not supported";
            }
        }


        $this->db->insert('user', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data user berhasil ditambahkan! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }

    public function Update($id)
    {
        $model = $this->db->get_where('user', ['id_user' => $id])->row();
        $data = [
            'nama' => ($this->input->post('nama') != '') ? $this->input->post('nama') : $model->nama,
            'username' => ($this->input->post('username') != '') ? $this->input->post('username') : $model->username,
            'password' => ($this->input->post('password')) ? password_hash($this->input->post('password'), PASSWORD_DEFAULT) : $model->password,
            'role' => ($this->input->post('role') != '') ? $this->input->post('role') : $model->role,
        ];

        $model = $this->db->get_where('user', ['id_user' => $id])->row();

        $config['upload_path']          = './upload/user/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = date('Y/m/d/h/i') . '-' . $data['username'];
        $config['overwrite']            = true;

        $this->load->library('upload', $config);
        $this->load->helper('file');
        if (!empty($_FILES['foto']['name'])) {
            if ($_FILES['foto']['name'] != $model->foto) {
                if (!$this->upload->do_upload('foto')) {
                    $data['foto'] = "def.png";
                    $alert = "format file not supported";
                } else {
                    $alert = "";
                    $file_name = $this->upload->data("file_name");
                    $data['foto'] = $file_name;
                    if ($model->foto != 'def.png') {
                        array_map('unlink', glob(FCPATH . "upload/user/$model->foto"));
                    }
                }
            }
        }

        $this->db->where('id_user', $id);
        $this->db->update('user', $data);
        if ($alert == "format file not supported") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>format file not supported! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data user berhasil diupdate! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
        }
    }

    public function Delete($id)
    {
        $this->db->delete('user', ['id_user' => $id]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Success</h5>Data user berhasil dihapus! <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
    }
}
