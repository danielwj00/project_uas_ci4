<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuruTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_guru' => [
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
		$this->forge->addKey('id_guru', true);
		$this->forge->createTable('guru');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('guru');
	}
}
