<?php

namespace App\Controllers;

use App\Models\PersediaanInventarisModel;
use App\Models\RiwayatInventarisModel;
use App\Models\TransaksiInventarisModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Inventaris extends Controller
{
    protected $inventarisModel;
    
    public function __construct()
    {
        $this->inventarisModel = new PersediaanInventarisModel();
    }

    public function index()
    {
        $data['persediaan'] = $this->inventarisModel->findAll();
        return view('inventaris/index', $data);
    }
}
