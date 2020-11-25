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
            'ipAddress' => array(
                'type' => 'varchar',
                'constraint' => 25
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
            'status' => array(
                'type' => 'varchar',
                'constraint' => 15,
            ),
            'createdAt datetime not null default current_timestamp',
            'updatedAt datetime not null default current_timestamp on update current_timestamp'
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('tbl_vote');
    }

    public function down()
    {
        $this->dbforge->drop_table('tbl_vote');
    }
}
