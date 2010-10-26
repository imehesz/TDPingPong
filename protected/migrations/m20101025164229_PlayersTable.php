<?php

class m20101025164229_PlayersTable extends CDbMigration {
    
    public function up() {
        // Create the posts table
        $t = $this->newTable('players');
        $t->primary_key('id');
        $t->string('name');
        $t->string('email');
        $t->string('photo');
        $t->integer('won');
        $t->integer('lost');
        $t->integer('created');
        $t->integer('updated');
        $this->addTable($t);
    }
    
    public function down() {
        $this->removeTable('players');
    }
    
}
