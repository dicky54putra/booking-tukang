<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_tugas extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_tugas' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_mapel' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'id_kelas' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'file' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'deadline' => array(
                'type' => 'DATETIME',
            ),
        ));
        $this->dbforge->add_key('id_tugas');
        $this->dbforge->create_table('tugas');
    }
    public function down()
    {
        $this->dbforge->drop_table('tugas');
    }
}
