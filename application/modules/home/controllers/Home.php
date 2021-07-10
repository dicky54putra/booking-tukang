<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		isLoginUser();
		__homeTemplate('home/index', [
			'title' => 'Dashboard'
		]);
	}

	public function login()
	{
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
		__homeTemplate('home/register', [
			'title' => 'Register',
		]);
	}
	public function logout()
	{
		if ($this->input->post('isPost') === 'true') {
			$data = [
				'username' => 'username',
				'role' => 'role',
				'login' => '',
			];
			$this->session->unset_userdata($data);
			redirect('login');
		}
	}

	private function _login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$user = $this->db->get_where('user', ['username' => $username])->row();

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
}
