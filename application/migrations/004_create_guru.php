<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_guru extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_guru' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'nip' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));
        $this->dbforge->add_key('id_guru');
        $this->dbforge->create_table('guru');
    }
    public function down()
    {
        $this->dbforge->drop_table('guru');
    }
}
