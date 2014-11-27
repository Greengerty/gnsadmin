<?php

class m141127_104845_blog_fields extends CDbMigration
{
	public function up()
	{
	    $this->execute("
	    	ALTER TABLE gns_news ADD category INT(11) NOT NULL AFTER id
	    ");

	    $this->execute("
	    	ALTER TABLE gns_news ADD intro text NOT NULL AFTER name 
	    ");

	    $this->execute("
	    	ALTER TABLE gns_news ADD author varchar(255) NOT NULL AFTER tags
	    ");

	    $this->execute("
	    	ALTER TABLE gns_news ADD views int(11) NOT NULL
	    ");

	    $this->execute("
	    	ALTER TABLE gns_news ADD popular enum('0','1') NOT NULL DEFAULT '0' AFTER status
	    ");

	    $this->execute("
	    	ALTER TABLE gns_news ADD media text NOT NULL AFTER intro
	    ");
	}

	public function down()
	{
	    $this->execute("
	    	ALTER TABLE gns_news DROP category
	    ");		
	    $this->execute("
	    	ALTER TABLE gns_news DROP intro
	    ");		
	    $this->execute("
	    	ALTER TABLE gns_news DROP author
	    ");		
	    $this->execute("
	    	ALTER TABLE gns_news DROP views
	    ");		
	    $this->execute("
	    	ALTER TABLE gns_news DROP popular
	    ");		
	    $this->execute("
	    	ALTER TABLE gns_news DROP media
	    ");		
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}