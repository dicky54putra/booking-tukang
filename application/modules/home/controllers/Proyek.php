<?php defined('BASEPATH') or exit('No direct script access allowed');

class Proyek extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proyek_model');
    }

    public function addToCart()
    {
        $this->Proyek_model->addToCart();
    }
}
