<?php defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
	private $tabel = 'user';
	public function addUser($nama, $username, $password, $role = 2, $foto = 'def.png')
	{
		return $this->db->insert($this->tabel, [
			'nama' => $nama,
			'username' => $username,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role' => $role,
			'foto' => $foto,
		]);
	}

	public function editAkun($id)
	{
		$password = $this->input->post('password');
		$data = [
			'username' => $this->input->post('username'),
		];

		if (!empty($password)) {
			$data['password'] = password_hash($password, PASSWORD_DEFAULT);
		}
		return $this->db->update($this->tabel, $data, ['id_user' => $id]);
	}
}
