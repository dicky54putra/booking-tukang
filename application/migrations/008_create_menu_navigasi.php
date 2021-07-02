<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_menu_navigasi extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_menu_navigasi' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'id_parent' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'icon' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'no_urut' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'status' => array(
                'type' => 'TINYINT',
                'constraint' => 1,
            ),
        ));
        $this->dbforge->add_key('id_menu_navigasi');
        $this->dbforge->create_table('menu_navigasi');
    }
    public function down()
    {
        $this->dbforge->drop_table('menu_navigasi');
    }
}
