<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKelasTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_kelas' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'name' => [
				'type' => 'varchar',
				'constraint' => '255'
			]
		]);
		$this->forge->addKey('id_kelas', true);
		$this->forge->createTable('kelas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('kelas');
	}
}
