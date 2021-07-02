<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Migration_create_materi extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id_materi' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'id_mapel' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'id_guru' => array(
                'type' => 'INT',
                'constraint' => 11,
            ),
            'file' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'keterangan' => array(
                'type' => 'TEXT',
            ),
        ));
        $this->dbforge->add_key('id_materi');
        $this->dbforge->create_table('materi');
    }
    public function down()
    {
        $this->dbforge->drop_table('materi');
    }
}
