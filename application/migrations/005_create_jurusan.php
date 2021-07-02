<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_jurusan extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_jurusan' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('id_jurusan');
        $this->dbforge->create_table('jurusan');
    }
    public function down()
    {
        $this->dbforge->drop_table('jurusan');
    }
}
