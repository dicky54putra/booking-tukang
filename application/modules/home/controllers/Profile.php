<?php defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        __homeTemplate('profile/index', [
            'title' => 'Dashboard',
            'titleApp' => 'Profile Tukang'
        ]);
    }
}
