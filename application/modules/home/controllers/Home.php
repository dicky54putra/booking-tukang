<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Home_model');
		$this->load->model('Pemesan_model');
		$this->load->model('Tukang_model');
	}

	public function index()
	{
		isLoginUser();

		$tukangs = $this->Tukang_model->all(20);
		__homeTemplate('home/index', [
			'title' => 'Dashboard',
			'tukangs' => $tukangs,
		]);
	}

	public function detail($id)
	{
		isLoginUser();

		$tukang = $this->Tukang_model->getById($id);
		$skills = explode(",", $tukang->skills);
		$pemesan = get_user_tabel();

		__homeTemplate('home/detailTukang', [
			'title' => 'Dashboard',
			'tukang' => $tukang,
			'skills' => $skills,
			'pemesan' => $pemesan,
		]);
	}

	public function login()
	{
		if ($this->session->userdata('login') == 'app') {
			redirect('home');
		}
		$post = $this->input->post();
		if ($post) {
			$this->_login();
		}
		__homeTemplate('home/login', [
			'title' => 'Login'
		]);
	}

	public function register()
	{
		if ($this->session->userdata('login') == 'app') {
			redirect('home');
		}
		$post = $this->input->post();
		if ($post) {
			$this->_register();
		}
		__homeTemplate('home/register', [
			'title' => 'Register',
		]);
	}
	public function logout()
	{
		if ($this->input->post('isPost') === 'true') {
			$data = [
				'username' => 'username',
				'login' => 'login',
				'id_user' => 'id_user',
				'id_role' => 'id_role'
			];
			$this->session->unset_userdata($data);
			redirect('login');
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['username' => $username, 'role !=' => 1])->row();

		if (!empty($user)) {
			if (password_verify($password, $user->password)) {
				$data = [
					'id_user' => $user->id_user,
					'username' => $user->username,
					'id_role' => $user->role,
					'login' => 'app',
				];
				$this->session->set_userdata($data);
				// redirect($this->input->post('url'));
				redirect('home');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Username atau Password salah!, silahkan periksa username dan password anda kembali !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
				redirect('login');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Username atau password salah!, silahkan periksa username dan password anda kembali !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
			redirect('login');
		}
	}

	private function _register()
	{
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$no_hp = $this->input->post('no_hp');
		$alamat = $this->input->post('alamat');

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->db->trans_start();
		$this->Home_model->addUser($nama, $username, $password);
		$user = $this->db->order_by('id_user', 'DESC')->get('user', 1)->row();
		$this->Pemesan_model->add($nama, $email, $no_hp, $alamat, $user->id_user);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger alert-solid alert-dismissible fade show" role="alert"><h5 class="alert-heading">Gagal</h5>Koneksi terputus !<button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
			redirect('register');
		}

		$this->_login();
	}
}
