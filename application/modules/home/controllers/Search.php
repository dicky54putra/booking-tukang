<?php defined('BASEPATH') or exit('No direct script access allowed');

class Search extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        __homeTemplate('search/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Cari Tukang'
        ]);
    }
}