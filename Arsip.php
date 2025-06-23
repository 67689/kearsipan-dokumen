<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Arsip_Model;
use App\Models\Bentuk_Arsip_Model;
use App\Models\Fond;
use App\Models\Fonds_Tahun_Model;
use App\Models\FondsTahun;
use App\Models\SubFond;
use App\Models\Seri_Model;
use App\Models\SubSeri_Model;

class Arsip extends BaseController
{
    protected $helpers = ['form'];

    public function index()
    {
        $header['title'] = 'Lihat Arsip';
        $data["js"] = "arsip/arsip_js";
        $data["id_tahun"] = $this->request->getGet('id'); // Ambil dari query string
        return $this->view('partial/header', $header)
            . $this->view('partial/top_menu')
            . $this->view('partial/side_menu')
            . $this->view('arsip/index', $data)
            . $this->view('partial/footer', $data);
    }

    // Method untuk menampilkan halaman tambah arsip
    public function add()
    {
        $header['title'] = 'Tambah Arsip';
    
        // Ambil semua data arsip
        $modelArsip = new Arsip_Model(); // Inisialisasi model Arsip
        $allArsip = $modelArsip->findAll();
    
        // Ambil data tahun dari model Fonds_Tahun_Model
        $fondsTahun = model(Fonds_Tahun_Model::class);
        $data['fondstahun'] = $fondsTahun->findAll();
    
        // Ambil hanya judul arsip unik (untuk kontributor)
        $uniqueJudul = [];
        $judulSeen = [];
    
        foreach ($allArsip as $arsip) {
            if (!in_array($arsip['judul_arsip'], $judulSeen)) {
                $judulSeen[] = $arsip['judul_arsip'];
                $uniqueJudul[] = $arsip; // Masukkan hanya arsip dengan judul unik
            }
        }
    
        $data['arsip'] = $uniqueJudul;
    
        // Komentar: bagian ini dulu digunakan untuk ambil data fonds/subfonds/seri/subseri
        // $data["fonds"] = $model->findAll();
        // $model1 = model(SubFond::class);
        // $data["subfonds"] = $model1->findAll();
        // $model2 = model(Seri_Model::class);
        // $data["seris"] = $model2->findAll();
        // $model3 = model(SubSeri_Model::class);
        // $data["subseris"] = $model3->findAll();
    
        $data["js"] = "arsip/arsip_js"; // File JS tambahan jika ada
    
        // Gabungkan view dengan layout template
        return $this->view('partial/header', $header)
            . $this->view('partial/top_menu')
            . $this->view('partial/side_menu')
            . $this->view('arsip/add', $data)
            . $this->view('partial/footer');
    }
    
    // Method untuk memproses penyimpanan arsip baru
    public function create()
    {
        helper(['form', 'filesystem']); // Load helper CI
        $role = session()->get('role'); // Ambil role dari session
        $idUser = session()->get('user_id'); // Ambil ID user dari session
    
        // Validasi input form
        $rules = [
            'judulArsip'       => 'required',
            'tanggal'          => 'required|valid_date',
            'jenisArsip'       => 'required',
            'tahun'            => 'required',
            'uploadFileArsip'  => 'uploaded[uploadFileArsip]|max_size[uploadFileArsip,10000]',
        ];
    
        // Jika validasi gagal, kembali ke form dengan input dan error
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        // Ambil nilai input form
        $judul      = $this->request->getPost('judulArsip');
        $tanggal    = $this->request->getPost('tanggal');
        $idTahun    = $this->request->getPost('tahun');
        $jenisArsip = $this->request->getPost('jenisArsip');
    
        // Ambil informasi berdasarkan role user
        if ($role == 1) { // Admin input informasi langsung
            $informasi = $this->request->getPost('informasi');
        } else {
            // Kontributor mengambil informasi dari arsip yang sudah ada (berdasarkan judul)
            $arsipModel = model(Arsip_Model::class);
            $existing = $arsipModel->where('judul_arsip', $judul)->first();
    
            if ($existing && isset($existing['informasi'])) {
                $informasi = $existing['informasi'];
            } else {
                $informasi = ''; // Jika tidak ditemukan, kosong
            }
        }
    
        // Proses file upload
        $file = $this->request->getFile('uploadFileArsip');
    
        // Validasi file
        if (!$file->isValid() || $file->hasMoved()) {
            return redirect()->back()->withInput()->with('error', 'File tidak valid.');
        }
    
        // Tentukan folder berdasarkan jenis arsip
        $folderMapping = [
            'Suara'   => 'audio/',
            'Gambar'  => 'gambar/',
            'Video'   => 'video/',
            'Dokumen' => 'dokumen/',
        ];
    
        // Jika jenis arsip tidak cocok
        if (!isset($folderMapping[$jenisArsip])) {
            return redirect()->back()->withInput()->with('error', 'Jenis arsip tidak dikenali.');
        }
    
        // Buat folder jika belum ada
        $folder = $folderMapping[$jenisArsip];
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }
    
        // Simpan file ke folder sesuai jenis arsip
        $newName = $file->getRandomName();
        $file->move($folder, $newName);
    
        // Ambil tahun dari ID
        $tahunModel = model(Fonds_Tahun_Model::class);
        $tahunData = $tahunModel->find($idTahun);
        $tahun = $tahunData ? $tahunData['tahun'] : null;
    
        // Simpan data ke database
        $model = model(Arsip_Model::class);
        $model->insert([
            'judul_arsip'     => $judul,
            'id_users'        => $idUser,
            'id_tahun'        => $idTahun,
            'tanggal'         => $tanggal,
            'tahun'           => $tahun,
            'jenis_arsip'     => $jenisArsip,
            'file_upload'     => $newName,
            'informasi'       => $informasi,
        ]);
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect('arsip.index')->with('success', 'Arsip berhasil ditambahkan');
    }





    // $validation = $this->validate([
    //     'subfondSuara' => [
    //         'rules' => 'mime_in[subfondSuara,audio/mpeg]|max_size[subfondSuara,10240]',
    //         'errors' => [
    //             'mime_in'  => 'Item harus berformat mp3',
    //             'max_size' => 'Ukuran file item maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'subfondGambar' => [
    //         'rules' => 'mime_in[subfondGambar,image/jpeg,image/png]|max_size[subfondGambar,10240]',
    //         'errors' => [
    //             'mime_in'  => 'subfondGambar harus berformat .jpeg atau .png.',
    //             'max_size' => 'Ukuran file subfondGambar maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'subfondVideo' => [
    //         'rules' => 'mime_in[subfondVideo,video/mp4]|max_size[subfondVideo,10240]',
    //         'errors' => [
    //             'mime_in'  => 'subfondVideo harus berformat .mp4',
    //             'max_size' => 'Ukuran file subfondVideo maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'suratKeluar' => [
    //         'rules' => 'mime_in[suratKeluar,application/pdf,application/msword]|max_size[suratKeluar,10240]',
    //         'errors' => [
    //             'mime_in'  => 'suratKeluar harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file suratKeluar maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'suratMasuk' => [
    //         'rules' => 'mime_in[suratMasuk,application/pdf,application/msword]|max_size[suratMasuk,10240]',
    //         'errors' => [
    //             'mime_in' => 'suratMasuk harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file suratMasuk maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'suratKeputusan' => [
    //         'rules' => 'mime_in[suratKeputusan,application/pdf,application/msword]|max_size[suratKeputusan,10240]',
    //         'errors' => [
    //             'mime_in' => 'suratKeputusan harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file suratKeputusan maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'keuangan' => [
    //         'rules' => 'mime_in[keuangan,application/pdf,application/msword]|max_size[keuangan,10240]',
    //         'errors' => [
    //             'mime_in' => 'keuangan harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file keuangan maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'pembayaranListrik' => [
    //         'rules' => 'mime_in[pembayaranListrik,application/pdf,application/msword]|max_size[pembayaranListrik,10240]',
    //         'errors' => [
    //             'mime_in' => 'pembayaranListrik harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file pembayaranListrik maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'pembayaranPAM' => [
    //         'rules' => 'mime_in[pembayaranPAM,application/pdf,application/msword]|max_size[pembayaranPAM,10240]',
    //         'errors' => [
    //             'mime_in' => 'pembayaranPAM harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file pembayaranPAM maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'internet' => [
    //         'rules' => 'mime_in[internet,application/pdf,application/msword]|max_size[internet,10240]',
    //         'errors' => [
    //             'mime_in' => 'internet harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file internet maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'tagihanSiswa' => [
    //         'rules' => 'mime_in[tagihanSiswa,application/pdf,application/msword]|max_size[tagihanSiswa,10240]',
    //         'errors' => [
    //             'mime_in' => 'tagihanSiswa harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file tagihanSiswa maksimal adalah 10MB.'
    //         ]
    //     ],
    //     'berita' => [
    //         'rules' => 'mime_in[berita,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[berita,10240]',
    //         'errors' => [
    //             'mime_in' => 'berita harus berformat .pdf atau .doc.',
    //             'max_size' => 'Ukuran file berita maksimal adalah 10MB.'
    //         ]
    //     ]
    // ]);

    // if (!$validation) {
    //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    // }

    // $asips = new Arsip_Model();
    // $data = [
    //     'judul_arsip' => $this->request->getPost('judulArsip'),
    //     'id_fonds_tahun' => $this->request->getPost('fondsTahun'),
    //     'informasi' => $this->request->getPost('informasi'),
    //     'eksistensi' => $this->request->getPost('eksistensi'),
    //     'sifat' => $this->request->getPost('sifat'),
    //     'tanggal' => $this->request->getPost('tanggal'),
    // ];
    // $asips->save($data);

    // $id_arsip = $asips->getInsertID();

    // $files = [
    //     'subfondSuara' => 'Sub Fonds Suara',
    //     'subfondGambar' => 'Sub Fonds Gambar',
    //     'subfondVideo' => 'Sub Fonds Video',
    //     'suratKeluar' => 'Surat Keluar',
    //     'suratMasuk' => 'Surat Masuk',
    //     'suratKeputusan' => 'Surat Keputusan',
    //     'keuangan' => 'Keuangan',
    //     'pembayaranListrik' => 'Pembayaran Listrik',
    //     'pembayaranPAM' => 'Pembayaran PAM',
    //     'internet' => 'Internet',
    //     'tagihanSiswa' => 'Tagihan Siswa',
    //     'berita' => 'Berita',
    // ];

    // $extToType = [
    //     'mp3' => 'Audio',
    //     'jpg' => 'Gambar',
    //     'jpeg' => 'Gambar',
    //     'png' => 'Gambar',
    //     'mp4' => 'Video',
    //     'pdf' => 'Dokumen',
    //     'doc' => 'Dokumen',
    //     'docx' => 'Dokumen',
    // ];

    // $folderMapping = [
    //     'subfondSuara' => 'audio/',
    //     'subfondGambar' => 'gambar/',
    //     'subfondVideo' => 'video/',
    //     'suratKeluar' => 'dokumen/surat_keluar/',
    //     'suratMasuk' => 'dokumen/surat_masuk/',
    //     'suratKeputusan' => 'dokumen/surat_keputusan/',
    //     'keuangan' => 'dokumen/keuangan/',
    //     'pembayaranListrik' => 'dokumen/pembayaran_listrik/',
    //     'pembayaranPAM' => 'dokumen/pembayaran_pam/',
    //     'internet' => 'dokumen/internet/',
    //     'tagihanSiswa' => 'dokumen/tagihan_siswa/',
    //     'berita' => 'dokumen/berita/',
    // ];


    // $bentukModel = new Bentuk_Arsip_Model();

    // foreach ($files as $field => $subfonds) {
    //     $file = $this->request->getFile($field);
    //     if ($file && $file->isValid() && !$file->hasMoved()) {
    //         $filename = $file->getRandomName();
    //         $folder = $folderMapping[$field] ?? 'uploads/';

    //         // Pastikan folder ada
    //         if (!is_dir($folder)) {
    //             mkdir($folder, 0777, true);
    //         }

    //         // Pindahkan file
    //         $file->move($folder, $filename);

    //         $ext = strtolower($file->getClientExtension());
    //         $bentuk = $extToType[$ext] ?? 'Lainnya';

    //         $bentukModel->save([
    //             'id_arsip'     => $id_arsip,
    //             'subfonds'     => $subfonds,
    //             'bentuk_arsip' => $bentuk,
    //             'nama_file'    => $filename,
    //             'tanggal'      => $this->request->getPost('tanggal'),
    //         ]);
    //     }
    // }

    // return redirect('arsip.index')->with('success', 'Arsip berhasil ditambahkan');


    public function edit($id)
    {
        $header['title'] = 'Edit arsip';
        $model = model(Arsip_Model::class);
        $data["js"] = "arsip/arsip_js";
        $ArsipId = $model->find($id);
        $data["arsip"] = $ArsipId;
        $allArsip = $model->findAll();
        $fondsTahun = model(Fonds_Tahun_Model::class);
        $data['fondstahun'] = $fondsTahun->findAll();

        // Buat array unik berdasarkan 'judul_arsip'
        $uniqueArsip = [];
        $seenJudul = [];

        foreach ($allArsip as $arsip) {
            if (!in_array($arsip['judul_arsip'], $seenJudul)) {
                $seenJudul[] = $arsip['judul_arsip'];
                $uniqueArsip[] = $arsip;
            }
        }

        $data["arsipjudul"] = $uniqueArsip;


        return $this->view('partial/header', $header)
            . $this->view('partial/top_menu')
            . $this->view('partial/side_menu')
            . $this->view('arsip/edit', $data)
            . $this->view('partial/footer');
    }

    public function update($id)
    {
        helper(['form', 'filesystem']);
        $role = session()->get(key: 'role');


        $rules = [
            'judulArsip'       => 'required',
            'tanggal'          => 'required|valid_date',
            'jenisArsip'       => 'required',
            'tahun'            => 'required',
        ];

        if ($this->request->getFile('uploadFileArsip')->isValid()) {
            $rules['uploadFileArsip'] = 'max_size[uploadFileArsip,10000]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $judul      = $this->request->getPost('judulArsip');
        $tanggal    = $this->request->getPost('tanggal');
        $tahun      = $this->request->getPost('tahun');
        $jenisArsip = $this->request->getPost('jenisArsip');

        if ($role == 1) {
            $informasi = $this->request->getPost('informasi');
        } else {
            $informasi = ''; // Atau default lain jika diperlukan
        }

        $folderMapping = [
            'Suara'   => 'audio/',
            'Gambar'  => 'gambar/',
            'Video'   => 'video/',
            'Dokumen' => 'dokumen/',
        ];

        if (!isset($folderMapping[$jenisArsip])) {
            return redirect()->back()->withInput()->with('error', 'Jenis arsip tidak dikenali.');
        }

        $model = model(Arsip_Model::class);
        $dataLama = $model->find($id);

        if (!$dataLama) {
            return redirect()->back()->with('error', 'Data arsip tidak ditemukan.');
        }

        $dataUpdate = [
            'judul_arsip'    => $judul,
            'tanggal'        => $tanggal,
            'tahun'          => $tahun,
            'jenis_arsip'    => $jenisArsip,
            'informasi'      => $informasi,
        ];

        $file = $this->request->getFile('uploadFileArsip');
        if ($file->isValid() && !$file->hasMoved()) {
            $folder = $folderMapping[$jenisArsip];
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            $newName = $file->getRandomName();
            $file->move($folder, $newName);

            // Hapus file lama jika ada
            $oldPath = $folder . $dataLama['file_upload'];
            if (is_file($oldPath)) {
                unlink($oldPath);
            }

            $dataUpdate['file_upload'] = $newName;
        }

        $model->update($id, $dataUpdate);

        return redirect('arsip.index')->with('success', 'Data arsip berhasil diperbarui.');
    }

    // public function update($id_arsip)
    // {
    //     $validation = $this->validate([
    //         // Aturan validasi sama seperti di create, sesuaikan jika perlu
    //         'subfondSuara' => [
    //             'rules' => 'mime_in[subfondSuara,audio/mpeg]|max_size[subfondSuara,10240]',
    //             'errors' => [
    //                 'mime_in'  => 'Item harus berformat mp3',
    //                 'max_size' => 'Ukuran file item maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'subfondGambar' => [
    //             'rules' => 'mime_in[subfondGambar,image/jpeg,image/png]|max_size[subfondGambar,10240]',
    //             'errors' => [
    //                 'mime_in'  => 'subfondGambar harus berformat .jpeg atau .png.',
    //                 'max_size' => 'Ukuran file subfondGambar maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'subfondVideo' => [
    //             'rules' => 'mime_in[subfondVideo,video/mp4]|max_size[subfondVideo,10240]',
    //             'errors' => [
    //                 'mime_in'  => 'subfondVideo harus berformat .mp4',
    //                 'max_size' => 'Ukuran file subfondVideo maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'suratKeluar' => [
    //             'rules' => 'mime_in[suratKeluar,application/pdf,application/mswordapplication/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[suratKeluar,10240]',
    //             'errors' => [
    //                 'mime_in'  => 'suratKeluar harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file suratKeluar maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'suratMasuk' => [
    //             'rules' => 'mime_in[suratMasuk,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[suratMasuk,10240]',
    //             'errors' => [
    //                 'mime_in' => 'suratMasuk harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file suratMasuk maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'suratKeputusan' => [
    //             'rules' => 'mime_in[suratKeputusan,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[suratKeputusan,10240]',
    //             'errors' => [
    //                 'mime_in' => 'suratKeputusan harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file suratKeputusan maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'keuangan' => [
    //             'rules' => 'mime_in[keuangan,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[keuangan,10240]',
    //             'errors' => [
    //                 'mime_in' => 'keuangan harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file keuangan maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'pembayaranListrik' => [
    //             'rules' => 'mime_in[pembayaranListrik,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[pembayaranListrik,10240]',
    //             'errors' => [
    //                 'mime_in' => 'pembayaranListrik harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file pembayaranListrik maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'pembayaranPAM' => [
    //             'rules' => 'mime_in[pembayaranPAM,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[pembayaranPAM,10240]',
    //             'errors' => [
    //                 'mime_in' => 'pembayaranPAM harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file pembayaranPAM maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'internet' => [
    //             'rules' => 'mime_in[internet,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[internet,10240]',
    //             'errors' => [
    //                 'mime_in' => 'internet harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file internet maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'tagihanSiswa' => [
    //             'rules' => 'mime_in[tagihanSiswa,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[tagihanSiswa,10240]',
    //             'errors' => [
    //                 'mime_in' => 'tagihanSiswa harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file tagihanSiswa maksimal adalah 10MB.'
    //             ]
    //         ],
    //         'berita' => [
    //             'rules' => 'mime_in[berita,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[berita,10240]',
    //             'errors' => [
    //                 'mime_in' => 'berita harus berformat .pdf atau .doc.',
    //                 'max_size' => 'Ukuran file berita maksimal adalah 10MB.'
    //             ]
    //         ]
    //     ]);

    //     if (!$validation) {
    //         return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    //     }

    //     $arsipModel = new Arsip_Model();
    //     $bentukModel = new Bentuk_Arsip_Model();

    //     // Update data arsip utama
    //     $data = [
    //         'judul_arsip' => $this->request->getPost('judulArsip'),
    //         'id_fonds_tahun' => $this->request->getPost('fondsTahun'),
    //         'informasi' => $this->request->getPost('informasi'),
    //         'eksistensi' => $this->request->getPost('eksistensi'),
    //         'sifat' => $this->request->getPost('sifat'),
    //         'tanggal' => $this->request->getPost('tanggal'),
    //     ];
    //     $arsipModel->update($id_arsip, $data);

    //     $files = [
    //         'subfondSuara' => 'Sub Fonds Suara',
    //         'subfondGambar' => 'Sub Fonds Gambar',
    //         'subfondVideo' => 'Sub Fonds Video',
    //         'suratKeluar' => 'Surat Keluar',
    //         'suratMasuk' => 'Surat Masuk',
    //         'suratKeputusan' => 'Surat Keputusan',
    //         'keuangan' => 'Keuangan',
    //         'pembayaranListrik' => 'Pembayaran Listrik',
    //         'pembayaranPAM' => 'Pembayaran PAM',
    //         'internet' => 'Internet',
    //         'tagihanSiswa' => 'Tagihan Siswa',
    //         'berita' => 'Berita',
    //     ];

    //     $extToType = [
    //         'mp3' => 'Audio',
    //         'jpg' => 'Gambar',
    //         'jpeg' => 'Gambar',
    //         'png' => 'Gambar',
    //         'mp4' => 'Video',
    //         'pdf' => 'Dokumen',
    //         'doc' => 'Dokumen',
    //         'docx' => 'Dokumen',
    //     ];

    //     $folderMapping = [
    //         'subfondSuara' => 'audio/',
    //         'subfondGambar' => 'gambar/',
    //         'subfondVideo' => 'video/',
    //         'suratKeluar' => 'dokumen/surat_keluar/',
    //         'suratMasuk' => 'dokumen/surat_masuk/',
    //         'suratKeputusan' => 'dokumen/surat_keputusan/',
    //         'keuangan' => 'dokumen/keuangan/',
    //         'pembayaranListrik' => 'dokumen/pembayaran_listrik/',
    //         'pembayaranPAM' => 'dokumen/pembayaran_pam/',
    //         'internet' => 'dokumen/internet/',
    //         'tagihanSiswa' => 'dokumen/tagihan_siswa/',
    //         'berita' => 'dokumen/berita/',
    //     ];

    //     foreach ($files as $field => $subfonds) {
    //         $file = $this->request->getFile($field);

    //         if ($file && $file->isValid() && !$file->hasMoved()) {
    //             // Cari data file lama di bentuk_arsip
    //             $oldFile = $bentukModel->where('id_arsip', $id_arsip)
    //                 ->where('subfonds', $subfonds)
    //                 ->first();

    //             // Hapus file lama jika ada
    //             if ($oldFile) {
    //                 $oldFilePath = FCPATH . ($folderMapping[$field] ?? 'uploads/') . $oldFile['nama_file'];
    //                 if (file_exists($oldFilePath)) {
    //                     unlink($oldFilePath);
    //                 }
    //                 // Hapus record lama
    //                 $bentukModel->delete($oldFile['id']);
    //             }

    //             // Upload file baru
    //             $filename = $file->getRandomName();
    //             $folder = $folderMapping[$field] ?? 'uploads/';

    //             if (!is_dir(FCPATH . $folder)) {
    //                 mkdir(FCPATH . $folder, 0777, true);
    //             }

    //             $file->move(FCPATH . $folder, $filename);

    //             $ext = strtolower($file->getClientExtension());
    //             $bentuk = $extToType[$ext] ?? 'Lainnya';

    //             // Simpan data baru di bentuk_arsip
    //             $bentukModel->save([
    //                 'id_arsip' => $id_arsip,
    //                 'subfonds' => $subfonds,
    //                 'bentuk_arsip' => $bentuk,
    //                 'nama_file' => $filename,
    //                 'tanggal' => $this->request->getPost('tanggal'),
    //             ]);
    //         }
    //         // Jika file tidak diupload, data lama tetap dipertahankan (tidak diubah)
    //     }

    //     return redirect('arsip.index')->with('success', 'Arsip berhasil diupdate');
    // }



    public function delete($id)
    {
        $header['title'] = 'Delete arsip';
        $model = model(Arsip_Model::class);
        $data["js"] = "arsip/arsip_js";
        $Arsip = $model->find($id);
        $data["arsip"] = $Arsip;


        return $this->view('partial/header', $header)
            . $this->view('partial/top_menu')
            . $this->view('partial/side_menu')
            . $this->view('arsip/delete', $data)
            . $this->view('partial/footer');
    }

    public function destroy($id)
    {
        helper('filesystem');

        $model = model(Arsip_Model::class);
        $arsip = $model->find($id);

        if (!$arsip) {
            return redirect()->back()->with('error', 'Data arsip tidak ditemukan.');
        }

        // Tentukan folder berdasarkan jenis arsip
        $folderMapping = [
            'Suara'   => 'audio/',
            'Gambar'  => 'gambar/',
            'Video'   => 'video/',
            'Dokumen' => 'dokumen/',
        ];

        $jenis = $arsip['jenis_arsip'];
        $folder = $folderMapping[$jenis] ?? null;

        if ($folder) {
            $filePath = $folder . $arsip['file_upload'];
            if (is_file($filePath)) {
                unlink($filePath); // Hapus file dari server
            }
        }

        // Hapus data dari database
        $model->delete($id);

        return redirect()->route('arsip.index')->with('success', 'Data arsip berhasil dihapus.');
    }


    // public function destroy($id)
    // {
    //     $arsipModel = model(Arsip_Model::class);
    //     $bentukModel = model(Bentuk_Arsip_Model::class);

    //     $arsip = $arsipModel->find($id);
    //     if (!$arsip) {
    //         return redirect()->back()->with('error', 'Data arsip tidak ditemukan');
    //     }

    //     // Ambil semua bentuk arsip yang terkait
    //     $bentukList = $bentukModel->where('id_arsip', $id)->findAll();

    //     // Mapping folder berdasarkan subfonds
    //     $folderMapping = [
    //         'Sub Fonds Suara' => 'audio/',
    //         'Sub Fonds Gambar' => 'gambar/',
    //         'Sub Fonds Video' => 'video/',
    //         'Surat Keluar' => 'dokumen/surat_keluar/',
    //         'Surat Masuk' => 'dokumen/surat_masuk/',
    //         'Surat Keputusan' => 'dokumen/surat_keputusan/',
    //         'Keuangan' => 'dokumen/keuangan/',
    //         'Pembayaran Listrik' => 'dokumen/pembayaran_listrik/',
    //         'Pembayaran PAM' => 'dokumen/pembayaran_pam/',
    //         'Internet' => 'dokumen/internet/',
    //         'Tagihan Siswa' => 'dokumen/tagihan_siswa/',
    //         'Berita' => 'dokumen/berita/',
    //     ];

    //     // Hapus semua file bentuk arsip
    //     foreach ($bentukList as $item) {
    //         $folder = $folderMapping[$item['subfonds']] ?? 'uploads/';
    //         $filePath = $folder . $item['nama_file'];
    //         if (file_exists($filePath)) {
    //             unlink($filePath);
    //         }
    //     }

    //     // Hapus bentuk arsip dari database
    //     $bentukModel->where('id_arsip', $id)->delete();

    //     // Hapus arsip utama
    //     $arsipModel->delete($id);

    //     return redirect('arsip.index')->with('success', 'Arsip dan bentuk arsip berhasil dihapus');
    // }


   public function ajax(string $action)
    {
        $model = model(Arsip_Model::class);
        $this->db = \Config\Database::connect();
        $result = [];

        if ($action === "get") {
            $idTahun = $this->request->getGet('id_tahun');

            // Query dengan filter tahun jika tersedia
            $builder = $this->db->table('arsip')
                ->select('id, judul_arsip, informasi, tanggal, tahun, jenis_arsip, file_upload')
                ->orderBy('id', 'DESC');

            if (!empty($idTahun)) {
                $builder->where('id_tahun', $idTahun);
            }

            $result = $builder->get()->getResultArray();
        } else if ($action === "delete") {
            if ($this->request->is('post')) {
                $id = $this->request->getPost("id");
                $model->delete($id);
                $result["status"] = $this->db->affectedRows() ? "success" : "error";
            }
        } else if ($action === "multidelete") {
            if ($this->request->is('post')) {
                $deleteids_arr = $this->request->getPost("deleteids_arr");
                foreach ($deleteids_arr as $deleteid) {
                    $model->delete($deleteid);
                }
                $result["status"] = $this->db->affectedRows() ? "success" : "error";
            }
        }

        echo json_encode($result);
    }

    // public function getSubFond()
    // {
    //     $idfonds=$this->request->getPost('id');
    //     // $idfonds='2';
    //     $this->db = \Config\Database::connect();
    //     $query = $this->db->query("SELECT * FROM sub_fonds where id_fonds='$idfonds'  ");
    //     $result = $query->getResultArray();
    //     foreach ($result as $rom) {
    //         // $hasil='<option value="'.$rom['id'].'">'.$rom["name"].' </option> ';
    //         $hasil=$rom['id'].' - '.$rom["name"];

    //     }
    //     $arrayName = array('hasil' => $hasil );
    //     echo json_encode($arrayName);

    // }    
}
