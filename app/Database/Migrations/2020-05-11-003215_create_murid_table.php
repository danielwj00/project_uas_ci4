<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMuridTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_murid' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'name' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'id_user' => [
				'type' => 'int'
			]
		]);
		$this->forge->addKey('id_murid', true);
		$this->forge->createTable('murid');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('murid');
	}
}
