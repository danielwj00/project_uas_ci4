<?php namespace App\Database\Seeds;
  
class MataPelajaranSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'id_mata_pelajaran' => 'MP0001',
            'name' => 'Membaca Buku Pake Mata Kaki'
        ];
        $this->db->table('mata_pelajaran')->insert($data1);
    }
}