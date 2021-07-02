<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_kelas extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_kelas' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_jurusan' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('id_kelas');
        $this->dbforge->create_table('kelas');
    }
    public function down()
    {
        $this->dbforge->drop_table('kelas');
    }
}
