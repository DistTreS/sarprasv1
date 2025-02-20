<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('pages/dashboard');
    }

    public function indexpegawai()
    {
        return view('pages/dashboardpegawai');
    }

    public function indexguest()
    {
        return view('pages/dashboardguest');
    }
}
