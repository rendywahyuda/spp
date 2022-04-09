<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'transaksi';
    protected $allowedFields = ['id_siswa', 'id_spp', 'id_tunggakan', 'id_bendahara', 'nama_siswa', 'kelas', 'tahun_pelajaran', 'jenis_spp', 'jenis_pembayaran', 'bukti_pembayaran', 'spp_bulan', 'nominal_bayar', 'status', 'notes'];
    protected $primaryKey = 'id_transaksi';
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getSiswaWhere($field, $nilai)
    {
        $builder = $this->db->table('transaksi')->where($field, $nilai);
        $builder->join('siswa', 'siswa.id_siswa = transaksi.id_siswa');
        return $builder->get()->getResultArray();
    }

    public function getSppWhere($field, $nilai)
    {
        $builder = $this->db->table('transaksi')->where($field, $nilai);
        $builder->join('spp', 'spp.id_spp = transaksi.id_spp');
        return $builder->get()->getResultArray();
    }

    public function getSiswa($id = false)
    {
        if ($id == false) {
            return $this->db->table('transaksi')
                ->join('siswa', 'siswa.id_siswa=transaksi.id_siswa')
                ->get()->getResultArray();
        } elseif ($id == true) {
            return $this->db->table('transaksi')->where('transaksi.id_transaksi', $id)
                ->select('*')
                ->join('siswa', 'siswa.id_siswa=transaksi.id_siswa')
                ->get()->getResultArray();
        }
    }

    public function getTransaksiWhere($field, $nilai, $field2, $nilai2)
    {
        return $this->where($field, $nilai)->where($field2, $nilai2)->findAll();
    }

    public function getPetugas($id = false)
    {
        if ($id == false) {
            return $this->db->table('transaksi')
                ->join('bendahara', 'bendahara.id_bendahara=transaksi.id_bendahara')
                ->get()->getResultArray();
        } elseif ($id == true) {
            return $this->db->table('transaksi')->where('transaksi.id_transaksi', $id)
                ->join('bendahara', 'bendahara.id_bendahara=transaksi.id_bendahara')
                ->get()->getResultArray();
        }
    }

    public function getTransaksi($id_transaksi = false)
    {
        if ($id_transaksi == false) {
            return $this->findAll();
        } elseif ($id_transaksi == true) {
            return $this->where(['id_transaksi' => $id_transaksi])->first();
        }
    }

    public function getTransaksiBulan($id_siswa)
    {
        $builder =  $this->where('id_siswa', $id_siswa);
        return $builder->where('status !=', 'pending')->select('spp_bulan')->findAll();
    }

    public function getPetugasWhere($field, $nilai)
    {
        $builder = $this->db->table('transaksi')->where($field, $nilai);
        $builder->join('bendahara', 'bendahara.id_bendahara = transaksi.id_bendahara');
        return $builder->get()->getResultArray();
    }

    public function searchAccept($keyword)
    {
        return $this->table('transaksi')->where(['status' => 'accept'])->like('spp_bulan', $keyword)
            ->orLike('nominal_bayar', $keyword)->orLike('created_at', $keyword);
    }

    public function searchPending($keyword)
    {
        return $this->table('transaksi')->where(['status' => 'pending'])->like('spp_bulan', $keyword)
            ->orLike('nominal_bayar', $keyword)->orLike('created_at', $keyword);
    }

    public function petugasSearchPending($keyword = false)
    {
        if ($keyword == false) {
            return $this->table('transaksi')->where(['status' => 'pending'])
                ->join('siswa', 'siswa.id_siswa = transaksi.id_siswa')->paginate(7, 'history');
        } elseif ($keyword == true) {
            return $this->table('transaksi')->where(['status' => 'pending'])
                ->like('nama_siswa', $keyword)
                ->orlike('spp_bulan', $keyword)
                ->orLike('nominal_bayar', $keyword)
                ->join('siswa', 'siswa.id_siswa = transaksi.id_siswa')->paginate(7, 'history');
        }
    }

    public function petugasHistory($keyword = false)
    {
        if ($keyword == false) {
            return $this->table('transaksi')->where(['status' => 'accept'])->paginate(7, 'history');
        } elseif ($keyword == true) {
            return $this->table('transaksi')->where(['status' => 'accept'])
                ->like('spp_bulan', $keyword)
                ->orLike('nama_siswa', $keyword)
                ->orLike('nominal_bayar', $keyword)->paginate(7, 'history');
        }
    }

    public function filter($kls)
    {
        return $this->table('transaksi')->where(['status' => 'pending'])
            ->like('kelas', $kls)
            // ->paginate(7, 'history');
            ->findAll();
    }

    public function filter2($tapel)
    {
        return $this->table('transaksi')->where(['status' => 'pending'])
            ->like('tahun_pelajaran', $tapel)
            // ->paginate(7, 'history');
            ->findAll();
    }

    public function filterHistory($kls)
    {
        return $this->table('transaksi')->where(['status' => 'accept'])
            ->like('kelas', $kls)
            // ->paginate(7, 'history');
            ->findAll();
    }

    public function filterHistory2($tapel)
    {
        return $this->table('transaksi')->where(['status' => 'accept'])
            ->like('tahun_pelajaran', $tapel)
            // ->paginate(7, 'history');
            ->findAll();
    }

    public function filterBulan($bulan)
    {
        return $this->table('transaksi')->where(['status' => 'accept'])
            ->like('spp_bulan', $bulan)
            // ->paginate(7, 'transaksi');
            ->findAll();
    }

    public function filterBulan2($bulan)
    {
        return $this->table('transaksi')->where(['status' => 'pending'])
            ->like('spp_bulan', $bulan)
            // ->paginate(7, 'transaksi');
            ->findAll();
    }

    public function filtertapelSiswa($tahun_pelajaran)
    {
        return $this->table('transaksi')->where(['status' => 'accept'])
            ->like('tahun_pelajaran', $tahun_pelajaran)
            // ->paginate(7, 'transaksi');
            ->findAll();
    }

    public function filtertapelSiswa2($tahun_pelajaran)
    {
        return $this->table('transaksi')->where(['status' => 'pending'])
            ->like('tahun_pelajaran', $tahun_pelajaran)
            // ->paginate(7, 'transaksi');
            ->findAll();
    }
}
