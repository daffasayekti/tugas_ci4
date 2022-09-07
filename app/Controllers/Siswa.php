<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class Siswa extends BaseController
{
    protected $siswaModel;

    public function __construct()
    {
        $this->siswaModel = new SiswaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Crud Data Siswa',
            'dataSiswa' => $this->siswaModel->findAll(),
            'validation' => \Config\Services::validation(),
        ];

        return view('index', $data);
    }

    public function create()
    {
        if (!$this->validate([
            'kd_siswa'   => [
                'label'  => 'Nama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'nama'   => [
                'label'  => 'Nama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'tempat_lahir'   => [
                'label'  => 'Tempat Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'tanggal_lahir'   => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'no_telp'   => [
                'label'  => 'Nomer Telepon',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'alamat'   => [
                'label'  => 'Alamat',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->to('/')->withInput();
        }

        $this->siswaModel->save([
            'kd_siswa'      => $this->request->getVar('kd_siswa'),
            'nama'          => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'no_telp'       => $this->request->getVar('no_telp'),
            'alamat'        => $this->request->getVar('alamat'),
        ]);

        session()->setFlashdata('success', 'Selamat!, Data Siswa Berhasil Ditambahkan');

        return redirect()->to('/');
    }

    public function edit($kd_siswa)
    {
        if (!$this->validate([
            'kd_siswa'   => [
                'label'  => 'Nama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'nama'   => [
                'label'  => 'Nama',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'tempat_lahir'   => [
                'label'  => 'Tempat Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'tanggal_lahir'   => [
                'label'  => 'Tanggal Lahir',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'no_telp'   => [
                'label'  => 'Nomer Telepon',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
            'alamat'   => [
                'label'  => 'Alamat',
                'rules'  => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong'
                ]
            ],
        ])) {
            return redirect()->to('/')->withInput();
        }

        $builder = $this->siswaModel->table('tb_siswa');

        $data = [
            'nama'          => $this->request->getVar('nama'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'tempat_lahir'  => $this->request->getVar('tempat_lahir'),
            'tanggal_lahir' => $this->request->getVar('tanggal_lahir'),
            'no_telp'       => $this->request->getVar('no_telp'),
            'alamat'        => $this->request->getVar('alamat'),
        ];

        $where = ['kd_siswa' => $kd_siswa];

        $builder->set($data)
            ->where($where)
            ->update();

        session()->setFlashdata('success', 'Selamat!, Data Siswa Berhasil Diedit');

        return redirect()->to('/');
    }

    public function delete($kd_siswa)
    {
        $this->siswaModel->delete_data_siswa($kd_siswa);

        session()->setFlashdata('success', 'Selamat!, Data Siswa Berhasil Dihapus');

        return redirect()->to('/');
    }
}
