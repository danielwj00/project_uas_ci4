<?php namespace App\Database\Seeds;
  
class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918',
            'birthdate' => '2000-10-31',
            'id_role' => 'R0001',
            'izin_edit' => 'true'
        ];
        $data2 = [
            'name' => 'Guru Pertama',
            'email' => 'gurupertama@email.com',
            'password' => '797a8bbbf1ce349c21cb610cc416b3c37dafa14ff7a7a8e4c6ef0f6300b111a2',
            'birthdate' => '1980-09-02',
            'id_role' => 'R0002',
            'izin_edit' => 'false'
        ];
        $data3 = [
            'name' => 'Murid Pertama',
            'email' => 'muridpertama@email.com',
            'password' => 'af9897ac1baf6509e362919d01658bf4684f0e33b61219b6a11bf66f4141ac32',
            'birthdate' => '2006-10-31',
            'id_role' => 'R0003',
            'izin_edit' => 'false'
        ];
        $this->db->table('user')->insert($data1);
        $this->db->table('user')->insert($data2);
        $this->db->table('user')->insert($data3);
    }
} 