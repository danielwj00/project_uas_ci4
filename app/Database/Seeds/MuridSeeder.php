<?php namespace App\Database\Seeds;
  
class MuridSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'id_murid' => 'M0001',
            'name' => 'Murid Pertama',
            'id_user' => '3'
        ];
        $this->db->table('murid')->insert($data1);
    }
} 