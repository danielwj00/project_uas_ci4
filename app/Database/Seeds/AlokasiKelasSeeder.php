<?php namespace App\Database\Seeds;
  
class AlokasiKelasSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'id_kelas' => 'K0001',
            'id_murid' => 'M0001',
            'id_guru' => 'G0001',
            'id_mata_pelajaran' => 'MP0001'
        ];
        $this->db->table('alokasi_kelas')->insert($data1);
    }
} 