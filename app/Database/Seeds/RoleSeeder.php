<?php namespace App\Database\Seeds;
  
class RoleSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'id_role'     => 'R0001',
            'name'   => 'admin'
        ];
        $data2 = [
            'id_role'     => 'R0002',
            'name'   => 'guru'
        ];
        $data3 = [
            'id_role'     => 'R0003',
            'name'   => 'murid'
        ];
        $this->db->table('role')->insert($data1);
        $this->db->table('role')->insert($data2);
        $this->db->table('role')->insert($data3);
    }
} 