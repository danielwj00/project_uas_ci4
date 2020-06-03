<?php namespace App\Database\Seeds;
  
class GuruSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'id_guru' => 'G0001',
            'name' => 'Guru Pertama',
            'id_user' => '2'
        ];
        $this->db->table('guru')->insert($data1);
    }
} 