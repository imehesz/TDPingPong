<?php

class m20101027225008_AddDeletedNotifyColumnToPlayers extends CDbMigration {
    
    public function up() {
		$this->addColumn( 'players', 'deleted', 'integer' );
		$this->addColumn( 'players', 'notify', 'integer' );
    }
    
    public function down() {
		$this->removeColumn( 'players', 'deleted' );
		$this->removeColumn( 'players', 'notify' );
    }
    
}
