<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->authentication->is_loggedin() === false) {
            $this->load->view('auth/login');
        } else {
            redirect('/');
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
		$password = $this->input->post('password');

        echo json_encode($this->authentication->login($username, $password));
    }

    public function logout()
    {
        $this->authentication->logout();
        redirect('login');
    }
}
