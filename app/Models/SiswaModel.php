<?php

namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model
{
    protected $table            = 'tb_siswa';
    protected $allowedFields    = ['kd_siswa', 'nama', 'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'no_telp', 'alamat'];

    public function delete_data_siswa($kd_siswa)
    {
        $sql = "DELETE FROM tb_siswa WHERE kd_siswa = '$kd_siswa'";
        $this->db->query($sql);
        return;
    }
}
