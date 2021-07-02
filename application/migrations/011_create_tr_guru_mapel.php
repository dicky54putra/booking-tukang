<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_tr_guru_mapel extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_guru' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'id_mapel' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->create_table('tr_guru_mapel');
    }
    public function down()
    {
        $this->dbforge->drop_table('tr_guru_mapel');
    }
}
