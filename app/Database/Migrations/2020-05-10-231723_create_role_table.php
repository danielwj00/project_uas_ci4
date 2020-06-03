<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRoleTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_role' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'name' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'description' => [
				'type' => 'text'
			]
		]);
		$this->forge->addKey('id_role', true);
		$this->forge->createTable('role');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('role');
	}
}
