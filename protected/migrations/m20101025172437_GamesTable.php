<?php

class m20101025172437_GamesTable extends CDbMigration {
    
    public function up() {
        // Create the posts table
        $t = $this->newTable('games');
        $t->primary_key('id');
        $t->string('name');
        $t->string('players_home');
        $t->string('players_visitor');
        $t->integer('score_home');
        $t->integer('score_visitor');
        $t->text( 'details' );
        $t->integer('created');
        $this->addTable($t);
    }
    
    public function down() {
        $this->removeTable('games');
    }
    
}
