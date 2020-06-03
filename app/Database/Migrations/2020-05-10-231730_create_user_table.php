<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_user' => [
				'type' => 'int',
				'auto_increment' => true
			],
			'email' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'password' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'name' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'birthdate' => [
				'type' => 'date'
			],
			'id_role' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'link_foto' => [
				'type' => 'varchar',
				'constraint' => '255',
				'default' => 'http://localhost/project_uas_ci4/assets/poster/default.png'
			],
			'izin_edit' => [
				'type' => 'varchar',
				'constraint' => '10',
				'default' => 'false'
			]
		]);
		$this->forge->addKey('id_user', true);
		$this->forge->addForeignKey('id_role','role','id_role','CASCADE','CASCADE');
		$this->forge->createTable('user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
