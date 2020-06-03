<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMataPelajaranTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_mata_pelajaran' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'name' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'description' => [
				'type' => 'varchar',
				'constraint' => '255'
			]
		]);
		$this->forge->addKey('id_mata_pelajaran', true);
		$this->forge->createTable('mata_pelajaran');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
