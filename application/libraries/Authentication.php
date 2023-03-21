<?php defined('BASEPATH') or exit('No direct script access allowed');

class Authentication
{
	private $ci;
	function __construct()
	{
		$this->ci = &get_instance();
		$this->ci->load->database();
		$this->ci->load->library('session');
	}

	public function is_loggedin()
	{
		return (bool) $this->ci->session->userdata('admin_id');
	}

	public function login($username, $password)
	{
		if ($username != "" || $password != "") {
			$this->ci->db->select('*');
			$this->ci->db->from('ref_admin');
			$this->ci->db->where('admin_username', $username);
			$user = $this->ci->db->get();
			if ($user->num_rows() == 0) {
				return FALSE;
			} else {
				if (password_verify($password, $user->row()->admin_password)) {
					if ($user->row()) {
						$data_login = array('admin_last_login' => date('Y-m-d H:i:s'));
						$where = array('admin_id', $user->row()->admin_id);
						$this->ci->db->update('ref_admin', $data_login, $where);
						
						$this->ci->session->set_userdata(array(
							'admin_id'           => $user->row()->admin_id,
							'admin_username'     => $user->row()->admin_username,
							'admin_nama'         => $user->row()->admin_nama,
							'admin_telp'         => $user->row()->admin_telp
						));
						return TRUE;
					} else {
						return FALSE;
					}
				} else {
					return FALSE;
				}
			}
		} else {
			return FALSE;
		}
	}

	public function logout()
	{
		$this->ci->session->unset_userdata('admin_id');
		$this->ci->session->unset_userdata('admin_username');
		$this->ci->session->unset_userdata('admin_nama');
		$this->ci->session->unset_userdata('admin_telp');
		return TRUE;
	}
}
