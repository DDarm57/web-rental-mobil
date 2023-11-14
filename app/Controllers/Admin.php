<?php

namespace App\Controllers;

use CodeIgniter\Database\SQLite3\Table;
use CodeIgniter\I18n\Time;

class Admin extends BaseController
{
    protected $db;
    public function __construct()
    {
        $this->db      = \Config\Database::connect();
    }

    public function dashboard()
    {
        $builder = $this->db->table('data_penyewa');
        $penyewa = $builder->countAllResults();

        $builder = $this->db->table('transaksi');
        $disewa = $builder->countAllResults();

        $builder = $this->db->table('jadwal_sewa');
        $builder->where('status', 'dijadwalkan');
        $jadwal = $builder->countAllResults();

        $builder = $this->db->table('selesai_sewa');
        $selesai = $builder->countAllResults();

        $data = [
            'tittle' => 'Dashboard',
            'penyewa' => $penyewa,
            'disewa' => $disewa,
            'jadwal' => $jadwal,
            'selesai' => $selesai
        ];

        return view('admin/dashboard', $data);
    }

    public function data_mobil()
    {
        $builder = $this->db->table('data_mobil');
        $query = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Data Mobil',
            'mobil' => $query
        ];

        return view('admin/data_mobil', $data);
    }

    public function tambah_mobil()
    {
        $data = [
            'tittle' => 'Tambah Data Mobil',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/tambah_mobil', $data);
    }

    public function simpan_mobil()
    {
        if (!$this->validate([
            'merek' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'merek mobil harus di isi'
                ]
            ],
            'no_pol' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'no pol harus di isi'
                ]
            ],
            'biaya' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'biaya harus di isi'
                ]
            ],
            'jumlah_kursi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jumlah kursi harus di isi'
                ]
            ],
            'gambar_penyewa' => [
                'rules' => 'is_image[gambar_mobil]|max_size[gambar_mobil,4032]|mime_in[gambar_mobil,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Yang anda masukan bukan gambar',
                    'max_size' => 'Maksimal gambar 4mb',
                    'mime_in' => 'Yang anda masukan bukan gambar'
                ]
            ],

        ])) {
            return redirect()->to(site_url('admin/tambah_mobil'))->withInput();
        }

        $gambar_mobil = $this->request->getFile('gambar_mobil');

        if ($gambar_mobil->getError() == 4) {
            $gmbnamaMobil = 'default.jpg';
        } else {
            $gmbnamaMobil = $gambar_mobil->getRandomName();
            $gambar_mobil->move('assets/mobil', $gmbnamaMobil);
        }

        $data = [
            'merek' => $this->request->getVar('merek'),
            'no_pol' => $this->request->getVar('no_pol'),
            'biaya' => $this->request->getVar('biaya'),
            'jumlah_kursi' => $this->request->getVar('jumlah_kursi'),
            'gambar_mobil' => $gmbnamaMobil
        ];

        $builder = $this->db->table('data_mobil');
        $builder->insert($data);

        session()->setFlashdata('pesan_hijau', 'Data mobil berhasil di tambahkan');
        return redirect()->to(site_url('admin/data_mobil'));
    }

    public function edit_mobil($id_mobil)
    {
        $builder = $this->db->table('data_mobil');
        $builder->where('id_mobil', $id_mobil);
        $query = $builder->get()->getRow();

        $data = [
            'tittle' => 'Edit Data Mobil',
            'mobil' => $query,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/edit_mobil', $data);
    }

    public function update_mobil()
    {
        if (!$this->validate([
            'gambar_penyewa' => [
                'rules' => 'is_image[gambar_mobil]|max_size[gambar_mobil,4032]|mime_in[gambar_mobil,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Yang anda masukan bukan gambar',
                    'max_size' => 'Maksimal gambar 4mb',
                    'mime_in' => 'Yang anda masukan bukan gambar'
                ]
            ],

        ])) {
            return redirect()->to(site_url('admin/tambah_mobil'))->withInput();
        }

        $gambar_mobil = $this->request->getFile('gambar_mobil');

        if ($gambar_mobil->getError() == 4) {
            $gmbnamaMobil = $this->request->getVar('gambar_lama');
        } else {
            $gmbnamaMobil = $gambar_mobil->getRandomName();
            $gambar_mobil->move('assets/mobil', $gmbnamaMobil);

            if ($this->request->getVar('gambar_lama') != 'default.jpg') {
                unlink('assets/mobil/' . $this->request->getVar('gambar_lama'));
            }
        }

        $data = [
            'merek' => $this->request->getVar('merek'),
            'no_pol' => $this->request->getVar('no_pol'),
            'biaya' => $this->request->getVar('biaya'),
            'jumlah_kursi' => $this->request->getVar('jumlah_kursi'),
            'gambar_mobil' => $gmbnamaMobil
        ];

        $builder = $this->db->table('data_mobil');
        $builder->where('id_mobil', $this->request->getVar('id_mobil'));
        $builder->update($data);

        session()->setFlashdata('pesan_hijau', 'data mobil berhasil di update');
        return redirect()->to(site_url('admin/data_mobil'));
    }

    public function hapus_mobil()
    {
        $builder = $this->db->table('jadwal_sewa');
        $get_id = $builder->get()->getRowArray();

        if ($this->request->getVar('id_mobil') == $get_id['J_mobilID']) {
            // dd('true');
            session()->setFlashdata('pesan_merah', 'data mobil gagal di hapus karena dengan id ' . $this->request->getVar('id_mobil') . ' ada data di list jadwal sewa');
            return redirect()->to(site_url('admin/data_mobil'));
        }
        // dd('false');

        $builder = $this->db->table('data_mobil', $this->request->getVar('id_mobil'));
        $builder->where('id_mobil',);
        $builder->delete();

        session()->setFlashdata('pesan_merah', 'data mobil berhasil di hapus');
        return redirect()->to(site_url('admin/data_mobil'));
    }

    public function data_penyewa()
    {
        $builder = $this->db->table('data_penyewa');
        $query = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Data Penyewa',
            'penyewa' => $query
        ];

        return view('admin/data_penyewa', $data);
    }

    public function tambah_penyewa()
    {
        $data = [
            'tittle' => 'Tambah Data Penyewa',
            'validation' => \Config\Services::validation()
        ];

        return view('admin/tambah_penyewa', $data);
    }

    public function simpan_penyewa()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required|is_unique[data_penyewa.nik]',
                'errors' => [
                    'required' => 'Nik harus di isi',
                    'is_unique' => 'Nik sudah terdaftar'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus di isi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus di isi'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin harus di isi pilih salah satu'
                ]
            ],
            'gambar_penyewa' => [
                'rules' => 'is_image[gambar_penyewa]|max_size[gambar_penyewa,4032]|mime_in[gambar_penyewa,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Yang anda masukan bukan gambar',
                    'max_size' => 'Maksimal gambar 4mb',
                    'mime_in' => 'Yang anda masukan bukan gambar'
                ]
            ],

        ])) {
            return redirect()->to(site_url('admin/tambah_penyewa'))->withInput();
        }

        $gambar_penyewa = $this->request->getFile('gambar_penyewa');

        if ($gambar_penyewa->getError() == 4) {
            $ambilnamaGambar = 'default.jpg';
        } else {
            $ambilnamaGambar = $gambar_penyewa->getRandomName();

            $gambar_penyewa->move('assets/penyewa', $ambilnamaGambar);
        }

        $data = [
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'gambar_penyewa' => $ambilnamaGambar
        ];

        $builder = $this->db->table('data_penyewa');
        $builder->insert($data);

        session()->setFlashdata('pesan_hijau', 'Data berhasil di tambahkan');
        return redirect()->to(site_url('admin/data_penyewa'));
    }

    public function edit_penyewa($id_penyewa)
    {
        $builder = $this->db->table('data_penyewa');
        $builder->where('id_penyewa', $id_penyewa);
        $query = $builder->get()->getRow();

        $data = [
            'tittle' => 'Edit Data Penyewa',
            'penyewa' => $query,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/edit_penyewa', $data);
    }

    public function update_penyewa()
    {
        if (!$this->validate([
            'nik' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nik harus di isi'
                ]
            ],
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus di isi'
                ]
            ],
            'alamat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat harus di isi'
                ]
            ],
            'jenis_kelamin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin harus di isi pilih salah satu'
                ]
            ],
            'gambar_penyewa' => [
                'rules' => 'is_image[gambar_penyewa]|max_size[gambar_penyewa,4032]|mime_in[gambar_penyewa,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'is_image' => 'Yang anda masukan bukan gambar',
                    'max_size' => 'Maksimal gambar 4mb',
                    'mime_in' => 'Yang anda masukan bukan gambar'
                ]
            ],
        ])) {
            return redirect()->to(site_url('admin/edit_penyewa'))->withInput();
        }

        $gambar_penyewa = $this->request->getFile('gambar_penyewa');

        if ($gambar_penyewa->getError() == 4) {
            $ambilnamaGambar = $this->request->getVar('gambar_lama');
        } else {
            $ambilnamaGambar = $gambar_penyewa->getRandomName();

            $gambar_penyewa->move('assets/penyewa', $ambilnamaGambar);
            if ($this->request->getVar('gambar_lama') != 'default.jpg') {
                unlink('assets/penyewa/' . $this->request->getVar('gambar_lama'));
            }
        }

        $data = [
            'nik' => $this->request->getVar('nik'),
            'nama' => $this->request->getVar('nama'),
            'alamat' => $this->request->getVar('alamat'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'gambar_penyewa' => $ambilnamaGambar
        ];

        $builder = $this->db->table('data_penyewa');
        $builder->where('id_penyewa', $this->request->getVar('id_penyewa'));
        $builder->update($data);

        session()->setFlashdata('pesan_hijau', 'data penyewa berhasil di ubah');
        return redirect()->to(site_url('admin/data_penyewa'));
    }

    public function hapus_penyewa()
    {
        $builder = $this->db->table('jadwal_sewa');
        $get_Idpenyewa = $builder->get()->getRowArray();

        if ($get_Idpenyewa['J_penyewaID'] == $this->request->getVar('id_penyewa')) {
            session()->setFlashdata('pesan_merah', 'data gagal di hapus karena id ' . $this->request->getVar('id_penyewa') . ' ada data jadwal atau transaksi yang sedang berjalan');
            return redirect()->to(site_url('admin/data_penyewa'));
        }


        $builder = $this->db->table('data_penyewa');
        $builder->where('id_penyewa', $this->request->getVar('id_penyewa'));
        $get = $builder->get()->getRowArray();

        if ($get['gambar_penyewa'] != 'default.jpg') {
            unlink('assets/penyewa/' . $get['gambar_penyewa']);
        }

        $builder = $this->db->table('data_penyewa');
        $builder->where('id_penyewa', $this->request->getVar('id_penyewa'));
        $builder->delete();

        session()->setFlashdata('pesan_hijau', 'data berhasil di hapus');
        return redirect()->to(site_url('admin/data_penyewa'));
    }

    public function data_jadwal()
    {

        $builder = $this->db->table('data_mobil');
        $query_mobil = $builder->get()->getResultArray();

        $builder = $this->db->table('data_penyewa');
        $query_penyewa = $builder->get()->getResultArray();
        // dd($get_data);

        $builder = $this->db->table('jadwal_sewa');
        $get_jadwal = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Buat Jadwal Transaksi',
            'mobil' => $query_mobil,
            'penyewa' => $query_penyewa,
            'jadwal' => $get_jadwal,
            'validation' => \Config\Services::validation()
        ];

        return view('admin/buat_jadwal', $data);
    }


    public function buat_jadwal()
    {
        if (!$this->validate([
            'id_penyewa' => [
                'rules' => 'required|is_unique[transaksi.penyewa_id]',
                'errors' => [
                    'required' => 'id penyewa harus di isi',
                    'is_unique' => 'id penyewa dengan id ' . $this->request->getVar('id_penyewa') . ' sudah ada di data jadwal'
                ]
            ],
            'id_mobil' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'id mobil harus di isi'
                ]
            ],
            'tanggal_sewa' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal sewa harus di isi'
                ]
            ],
            'tanggal_kembali' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'tanggal kembali harus di isi'
                ]
            ]

        ])) {
            return redirect()->to(site_url('admin/data_jadwal'))->withInput();
        }

        $builder = $this->db->table('data_mobil');
        $builder->where('id_mobil', $this->request->getVar('id_mobil'));
        $query_mobil = $builder->get()->getRow();

        $get_biaya = $query_mobil->biaya;

        $timeNow = date('H:i:s');
        //tanggal sewa
        $tanggal_sewa = $this->request->getVar('tanggal_sewa');
        $spasi = ' ';
        $get_tglSewa = $tanggal_sewa . $spasi . $this->request->getVar('tutup_boking');

        //tanggal kembali
        $tanggal_kembali = $this->request->getVar('tanggal_kembali');
        $spasi = ' ';
        $get_tglKembali = $tanggal_kembali . $spasi . $this->request->getVar('tutup_boking');

        $data = [
            'mobil_id' => $this->request->getVar('id_mobil'),
            'penyewa_id' => $this->request->getVar('id_penyewa'),
            'harga' => $get_biaya,
            'tanggal_sewa' => $get_tglSewa,
            'tanggal_kembali' => $get_tglKembali,
            'status_jadwal' => $this->request->getVar('status'),
            'dp_dibayar' => $this->request->getVar('bayar_dp'),
            'created_at' => Time::now()
        ];

        $builder = $this->db->table('transaksi');
        $builder->insert($data);

        $data_jadwal = [
            'J_penyewaID' => $this->request->getVar('id_penyewa'),
            'J_mobilID' => $this->request->getVar('id_mobil'),
            'waktu_boking' => $this->request->getVar('waktu_boking'),
            'tutup_boking' => $this->request->getVar('tutup_boking'),
            'bayar_dp' => $this->request->getVar('bayar_dp'),
            'status' => $this->request->getVar('status')
        ];

        $builder = $this->db->table('jadwal_sewa');
        $builder->insert($data_jadwal);

        session()->setFlashdata('pesan_hijau', 'transaksi berhasil di tambahkan');
        return redirect()->to(site_url('admin/data_jadwal'));
    }

    public function update_jadwal($penyewa_id)
    {
        $timeNow = date('H:i:s');
        $builder = $this->db->table('jadwal_sewa');
        $builder->where('J_penyewaID', $penyewa_id);
        $get_jadwal = $builder->get()->getRow();

        // dd($get_jadwal);

        if ($timeNow > $get_jadwal->tutup_boking) {
            // return redirect()->to(site_url('admin/data_jadwal'));
            $builder = $this->db->table('jadwal_sewa');
            $builder->set('status', 'mulai');
            $builder->where('J_penyewaID', $penyewa_id);
            $builder->update();

            $builder = $this->db->table('transaksi');
            $builder->set('status_jadwal', 'mulai');
            $builder->where('penyewa_id', $penyewa_id);
            $builder->update();

            return redirect()->to(site_url('admin/data_jadwal'));
        } else {
            return redirect()->to(site_url('admin/data_jadwal'));
        }
    }

    public function hapus_jadwal()
    {
        $builder = $this->db->table('jadwal_sewa');
        $builder->where('J_penyewaID', $this->request->getVar('id_jadwal'))->delete();

        $builder = $this->db->table('transaksi');
        $builder->where('penyewa_id', $this->request->getVar('id_jadwal'))->delete();

        session()->setFlashdata('pesan_merah', 'data jadwal dan data transaksi berdasarkan penyewa berhasil di hapus');
        return redirect()->to(site_url('admin/data_jadwal'));
    }

    public function transaksi()
    {

        $builder = $this->db->table('transaksi');
        $builder->where('status_jadwal', 'mulai');
        $get_transaksi = $builder->get()->getResultArray();

        //keyword pencarian
        // $keyword = $this->request->getVar('keyword');

        // if ($keyword) {
        //     $builder = $this->db->table('transaksi');
        //     $builder->like('penyewa_id', $keyword)->orLike('mobil_id', $keyword);
        //     $get_transaksi = $builder->get()->getResultArray();
        // } else {
        //     $builder = $this->db->table('transaksi');
        //     $get_transaksi = $builder->get()->getResultArray();
        // }

        //keyword pencarian

        $data = [
            'tittle' => 'Data Transaksi',
            'transaksi' => $get_transaksi,
        ];

        return view('admin/transaksi', $data);
    }

    public function cek_detail($penyewa_id)
    {
        //hari ini
        $now = Time::now();

        $builder = $this->db->table('transaksi');
        $builder->where('penyewa_id', $penyewa_id);
        $row = $builder->get()->getRow();

        // if ($now <= $row->tanggal_kembali) {
        //     continue;
        // }
        if ($now > $row->tanggal_kembali) {
            $sewa_perhari = date_diff(date_create($row->tanggal_sewa), date_create($row->tanggal_kembali))->format('%d');
            $terlambat = date_diff(date_create($now), date_create($row->tanggal_kembali))->format('%d');
            $sewa_mobil = $row->harga;
            $total_sewa = $sewa_perhari * $sewa_mobil;
            $kalikan = $terlambat * $sewa_mobil;
            $jumlah = $kalikan + $total_sewa;
            $jumlah_keseluruhan = $jumlah - $row->dp_dibayar;
            $total_hari = $sewa_perhari + $terlambat;
            // $hitung = date_diff(date_create($now), date_create($row->tanggal_kembali))->format('%d');
            // $kalikan = $hitung * $row->harga;
            // $jumlah = $kalikan + $row->harga;
            // $hitung = $row->harga + $row->harga;
            // dd($total_hari);
        } else {
            $sewa_perhari = date_diff(date_create($row->tanggal_sewa), date_create($row->tanggal_kembali))->format('%d');
            $terlambat = 0;
            $sewa_mobil = $row->harga;
            $total_sewa = $sewa_perhari * $sewa_mobil;
            $kalikan = $terlambat * $sewa_mobil;
            $jumlah = $kalikan + $total_sewa;
            $jumlah_keseluruhan = $jumlah - $row->dp_dibayar;
            $total_hari = $sewa_perhari + $terlambat;
        }

        $builder->set('denda', $kalikan);
        $builder->set('terlambat', $terlambat);
        $builder->set('sewa_perhari', $sewa_perhari);
        $builder->set('total_sewa', $total_sewa);
        $builder->set('total_hari', $total_hari);
        $builder->set('total', $jumlah_keseluruhan);
        $builder->where('penyewa_id', $penyewa_id);
        $builder->update();

        return redirect()->to(site_url('admin/detail_transaksi/' . $penyewa_id));
    }

    public function detail_transaksi($penyewa_id)
    {
        $builder = $this->db->table('transaksi');
        $builder->select('*');
        $builder->join('data_mobil', 'data_mobil.id_mobil = transaksi.mobil_id', 'left');
        $builder->where('penyewa_id', $penyewa_id);
        $query = $builder->get()->getResultArray();

        $builder = $this->db->table('data_penyewa');
        $builder->where('id_penyewa', $penyewa_id);
        $get_penyewa = $builder->get()->getRow();

        $builder = $this->db->table('jadwal_sewa');
        $builder->where('J_penyewaID', $penyewa_id);
        $get_jadwal = $builder->get()->getRow();

        $builder = $this->db->table('transaksi');
        $builder->select('*');
        $builder->join('data_mobil', 'data_mobil.id_mobil = transaksi.mobil_id');
        $builder->where('penyewa_id', $penyewa_id);
        $query_cekout = $builder->get()->getRow();
        // dd($query_cekout);

        $data = [
            'tittle' => 'Detail Transaksi',
            'penyewa' => $get_penyewa,
            'mobil' => $query,
            'cekout' => $query_cekout,
            'jadwal' => $get_jadwal
        ];

        return view('admin/detail_transaksi', $data);
    }

    public function bayar()
    {
        $data = [
            'S_mobilID' => $this->request->getvar('S_mobilID'),
            'S_penyewaID' => $this->request->getvar('S_penyewaID'),
            'boking_waktu' => $this->request->getvar('boking_waktu'),
            'boking_tutup' => $this->request->getvar('boking_tutup'),
            'sewa' => $this->request->getvar('sewa'),
            'kembali' => $this->request->getvar('kembali'),
            'biaya_sewaMobil' => $this->request->getvar('biaya_sewaMobil'),
            'total_hariSewa' => $this->request->getvar('total_hariSewa'),
            'total_hariSemua' => $this->request->getvar('total_hariSemua'),
            'total_biayaSewa' => $this->request->getvar('total_biayaSewa'),
            'terlambat_sewa' => $this->request->getvar('terlambat_sewa'),
            'total_denda' => $this->request->getvar('total_denda'),
            'dp' => $this->request->getvar('dp'),
            'total_keseluruhan' => $this->request->getvar('total_keseluruhan'),
            'created_at' => Time::now()
        ];

        $builder = $this->db->table('selesai_sewa');
        $builder->insert($data);

        $builder = $this->db->table('jadwal_sewa');
        $builder->where('J_penyewaID', $this->request->getvar('S_penyewaID'));
        $builder->delete();

        $builder = $this->db->table('transaksi');
        $builder->where('penyewa_id', $this->request->getvar('S_penyewaID'));
        $builder->delete();

        session()->setFlashdata('pesan_hijau', 'Terimakasi sudah melakukan pembayaran');
        return redirect()->to(site_url('admin/transaksi_selesai'));
    }

    public function transaksi_selesai()
    {
        $builder = $this->db->table('selesai_sewa');
        $query = $builder->get()->getResultArray();

        $data = [
            'tittle' => 'Riwayat Transaksi',
            'selesai' => $query
        ];

        return view('admin/transaksi_selesai', $data);
    }
}
