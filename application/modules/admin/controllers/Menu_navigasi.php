<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_navigasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Menu_navigasi_model');
        is_logged_in();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Menu Navigasi',
        ];
        if (!empty($_GET['q'])) {
            $data['data'] = $this->Menu_navigasi_model->getIndexSearch($_GET['q']);
        } else {
            $data['data'] = $this->Menu_navigasi_model->getIndex();
        }
        $this->load->view('template/header', $data);
        $this->load->view('menu_navigasi/index', $data);
        $this->load->view('template/footer');
    }

    public function view($id)
    {
        $data = [
            'title' => 'Data Menu Navigasi Detail',
            'data' => $this->Menu_navigasi_model->getOne($id),
            'data_loop' => $this->Menu_navigasi_model->getView($id),
            'func' => $this->uri->segment(2)
        ];
        if (!empty($data['data'])) {
            $this->load->view('template/header', $data);
            $this->load->view('menu_navigasi/view', $data);
            $this->load->view('template/footer');
        } else {
            $this->load->view('auth/blocked');
        }
    }

    public function create()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $data = [
                'title' => 'Tambah Data Menu Navigasi',
                'action' => base_url('menu_navigasi/create')
            ];
            $this->load->view('template/header', $data);
            $this->load->view('menu_navigasi/create', $data);
            $this->load->view('template/footer');
        } else {
            $this->Menu_navigasi_model->Add();
            $mn = $this->db->order_by('id_menu_navigasi', 'DESC')->get('menu_navigasi')->row();
            redirect('menu_navigasi/view/' . $mn->id_menu_navigasi);
        }
    }

    public function update($id)
    {
        $data = [
            'title' => 'Ubah Data Menu Navigasi',
            'data' => $this->Menu_navigasi_model->getOne($id),
            'action' => base_url('menu_navigasi/update/') . $id
        ];
        if (!empty($data['data'])) {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('url', 'Url', 'required');
            $this->form_validation->set_rules('icon', 'Icon', 'required');

            if ($this->form_validation->run() == false) {
                $this->load->view('template/header', $data);
                $this->load->view('menu_navigasi/update', $data);
                $this->load->view('template/footer');
            } else {
                $this->Menu_navigasi_model->Update($id);
                redirect('menu_navigasi/view/' . $id);
            }
        } else {
            $this->load->view('auth/blocked');
        }
    }

    public function delete($id)
    {
        $this->Menu_navigasi_model->Delete($id);
        redirect('menu_navigasi/index');
    }

    public function role($id)
    {
        $data = $this->input->post('role');
        $menu = $this->input->post('id_menu_navigasi');
        $this->db->delete('tr_menu_navigasi', ['id_menu_navigasi' => $menu]);
        foreach ($data as $key => $value) {
            $data = [
                'id_menu_navigasi' => $menu,
                'id_role' => $value
            ];
            $this->db->insert('tr_menu_navigasi', $data);
        }
        redirect('menu_navigasi/view/' . $id);
    }

    public function status($id, $func = null)
    {
        $cek = $this->Menu_navigasi_model->getOne($id);
        if ($cek->status == 0) {
            $this->db->where(['id_menu_navigasi' => $id])->update('menu_navigasi', ['status' => 1]);
        } else if ($cek->status == 1) {
            $this->db->where(['id_menu_navigasi' => $id])->update('menu_navigasi', ['status' => 0]);
        }
        if ($cek->id_parent > 0) {
            redirect('menu_navigasi/view/' . $cek->id_parent);
        } else if (!empty($func)) {
            redirect('menu_navigasi/view/' . $cek->id_menu_navigasi);
        } else {
            redirect('menu_navigasi');
        }
    }

    function s_autocomplete()
    {
        if (isset($_GET['q'])) {
            $result = $this->Menu_navigasi_model->getIndexSearch($_GET['q']);
            // echo count($result);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->nama;
                echo json_encode($arr_result);
            }
        }
    }
}
