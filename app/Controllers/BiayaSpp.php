<?php

namespace App\Controllers;

use App\Models\BiayaSppModel;
use App\Models\SppModel;
use App\Models\TahunPelajaranModel;
use App\Models\BendaharaModel;

class BiayaSpp extends BaseController
{
    protected $biayaSpp;
    protected $bendaharaModel;
    protected $spp;

    public function __construct()
    {
        $this->biayaSpp = new BiayaSppModel();
        $this->spp = new SppModel();
        $this->bendaharaModel = new BendaharaModel();
    }

    public function index()
    {
        $biayaSpp = $this->biayaSpp->getBiayaSpp();
        $currentPage = $this->request->getVar('page_biaya_spp') ? $this->request->getVar('page_biaya_spp') : 1;

        $data = [
            'title' => 'Biaya Spp',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'biayaSpp' => $biayaSpp,
            'pager' => $this->biayaSpp->pager,
            'currentPage' => $currentPage,
        ];

        return view('/bendahara/biaya_spp_index', $data);
    }

    public function create()
    {
        helper(['form']);
        $biayaSpp = $this->biayaSpp->getBiayaSpp();
        $tapelModel = new TahunPelajaranModel();
        function tapel()
        {
            $tahunAwal = 2015;
            $tahunAkhir = $tahunAwal + 1;
            $a = 1;
            $b = 30;
            $tapel = [];
            do {
                $tapel[] = implode('-', [$tahunAwal, $tahunAkhir]);
                $tahunAwal++;
                $tahunAkhir++;
                $a++;
            } while ($a <= $b);
            return $tapel;
        }

        $data = [
            'title' => 'Tambah Biaya SPP',
            'bendahara' => $this->bendaharaModel->where('id_bendahara', session()->get('id_bendahara'))->first(),
            'biayaSpp' => $biayaSpp,
            'tapel' => tapel(),
            'validation' => \Config\Services::validation()
        ];
        return view('bendahara/biaya_spp_create', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'kode' => 'required',
            'seragam' => 'required|numeric',
            'spp_bulanan' => 'required|numeric',
            'uang_bangunan' => 'required|numeric',
            'prakerin' => 'required|numeric',
            'ujikom' => 'required|numeric',
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/bendahara/biayaspp/create')->withInput()->with('validation', $validation);
        }
        $total = $this->request->getVar('seragam') + $this->request->getVar('spp_bulanan') + $this->request->getVar('uang_bangunan')
            + $this->request->getVar('prakerin') + $this->request->getVar('ujikom');
        $this->biayaSpp->save([
            'kode' => $this->request->getVar('kode'),
            'total' => $total,
            'seragam' => $this->request->getVar('seragam'),
            'spp_bulanan' => $this->request->getVar('spp_bulanan'),
            'uang_bangunan' => $this->request->getVar('uang_bangunan'),
            'prakerin' => $this->request->getVar('prakerin'),
            'ujikom' => $this->request->getVar('ujikom'),
        ]);
        session()->setFlashdata('success', 'Berhasil Ditambahkan');
        return redirect()->to('/bendahara/biayaspp');
    }
}
