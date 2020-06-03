<?php namespace App\Database\Seeds;
  
class KelasSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'id_kelas' => 'K0001',
            'name' => '1A'
        ];
        $this->db->table('kelas')->insert($data1);
    }
} 