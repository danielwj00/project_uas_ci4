<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAlokasiKelasTable extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_alokasi' => [
				'type' => 'int',
				'auto_increment' => true
			],
			'id_kelas' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'id_murid' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'id_guru' => [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'id_mata_pelajaran'=> [
				'type' => 'varchar',
				'constraint' => '255'
			],
			'nilai_tugas' => [
				'type' => 'int',
				'constraint' => 11,
				'default' => '0'
			],
			'nilai_uts' => [
				'type' => 'int',
				'constraint' => 11,
				'default' => '0'
			],
			'nilai_uas' => [
				'type' => 'int',
				'constraint' => 11,
				'default' => '0'
			],
			'nilai_akhir' => [
				'type' => 'int',
				'constraint' => 11,
				'default' => '0'
			]
		]);
		$this->forge->addKey('id_alokasi', true);
		// $this->forge->addForeignKey('id_kelas','kelas','id_kelas','CASCADE','CASCADE');
		// $this->forge->addForeignKey('id_murid','murid','id_murid','CASCADE','CASCADE');
		// $this->forge->addForeignKey('id_guru','guru','id_guru','CASCADE','CASCADE');
		// $this->forge->addForeignKey('id_mata_pelajaran', 'mata_pelajaran', 'id_mata_pelajaran', 'CASCADE', 'CASCADE');
		$this->forge->createTable('alokasi_kelas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('alokasi_kelas');
	}
}
