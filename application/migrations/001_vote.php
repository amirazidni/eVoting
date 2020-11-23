<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Vote extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'deviceToken' => array(
                'type' => 'tinytext',
                'index' => true
            ),
            'captchaToken' => array(
                'type' => 'tinytext',
                'index' => true,
                'null' => TRUE,
            ),
            'userId' => array(
                'type' => 'tinytext',
                'index' => true,
                'null' => TRUE,
            ),
            'photoPath' => array(
                'type' => 'tinytext',
                'index' => true,
                'null' => TRUE,
            ),
            'vote' => array(
                'type' => 'tinytext',
                'index' => true,
                'null' => TRUE,
            ),
            'note' => array(
                'type' => 'text',
                'null' => TRUE,
            ),
            'createdAt datetime default current_timestamp',
            'updatedAt datetime default current_timestamp'
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_vote');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_vote');
    }
}
