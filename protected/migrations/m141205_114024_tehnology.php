<?php

class m141205_114024_tehnology extends CDbMigration
{
	public function up()
	{
	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_technology` (
			  `id` int(11) NOT NULL,
 		      `name` varchar(255) NOT NULL,
 		      `alias` varchar(255) NOT NULL,
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			ALTER TABLE `gns_technology` ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_technology` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");	    	    

	}

	public function down()
	{
		$this->dropTable('gns_technology');
		return true;
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