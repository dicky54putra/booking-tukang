<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard'
		];
		$this->load->view(__HOME . 'template/header', $data);
		$this->load->view(__HOME . 'home/index', $data);
		$this->load->view(__HOME . 'template/footer');
	}

	public function login()
	{
		$data = [
			'title' => 'Login'
		];
		$this->load->view(__HOME . 'template/header', $data);
		$this->load->view(__HOME . 'home/login', $data);
		$this->load->view(__HOME . 'template/footer');
	}

	public function register()
	{
		__homeTemplate('home/register', [
			'title' => 'Register',
		]);
	}
}
