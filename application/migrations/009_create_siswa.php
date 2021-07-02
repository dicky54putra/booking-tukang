<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_siswa extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_siswa' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'nis' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'id_kelas' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('id_siswa');
        $this->dbforge->create_table('siswa');
    }
    public function down()
    {
        $this->dbforge->drop_table('siswa');
    }
}
