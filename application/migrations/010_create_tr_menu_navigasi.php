<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_tr_menu_navigasi extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_menu_navigasi' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'id_role' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->create_table('tr_menu_navigasi');
    }
    public function down()
    {
        $this->dbforge->drop_table('tr_menu_navigasi');
    }
}
