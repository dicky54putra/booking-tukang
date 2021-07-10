<?php defined('BASEPATH') or exit('No direct script access allowed');

class History extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        isLoginUser();
    }

    public function index()
    {
        __homeTemplate('history/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Riwayat Pekerjaan'
        ]);
    }
}
