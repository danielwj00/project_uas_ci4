<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotificationTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_notification' => [
				'type' => 'int',
				'auto_increment' => true
			],
			'from_id_user' => [
				'type' => 'int'
			],
			'to_id_user' => [
				'type' => 'int'
			],
			'message' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'read' => [
				'type' => 'varchar',
				'constraint' => '10',
				'default' => 'false'
			]
		]);
		$this->forge->addKey('id_notification', true);
		$this->forge->createTable('notification');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
