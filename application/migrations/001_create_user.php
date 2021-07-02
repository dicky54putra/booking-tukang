<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_user extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'role' => array(
                'type' => 'TINYINT',
                'constraint' => '1',
            ),
            'foto' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
        ));
        $this->dbforge->add_key('id_user');
        $this->dbforge->create_table('user');
    }
    public function down()
    {
        $this->dbforge->drop_table('user');
    }
}
