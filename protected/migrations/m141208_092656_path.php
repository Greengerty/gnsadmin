<?php

class m141208_092656_path extends CDbMigration
{
	public function up()
	{
		/* path table */
	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_path` (
			  `id` int(11) NOT NULL,
 		      `name` varchar(255) NOT NULL,
 		      `alias` varchar(255) NOT NULL,
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			ALTER TABLE `gns_path` ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_path` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");	  

		/* path to tech table */
	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_path_technology` (
			  `id` int(11) NOT NULL,
			  `id_path` int(11) NOT NULL,
			  `id_technology` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			ALTER TABLE `gns_path_technology` ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_path_technology` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");	    
	    
	    $this->execute("
			ALTER TABLE `gns_path_technology` ADD INDEX `id_technology` (`id_technology`)
	    ");

	    $this->execute("
			ALTER TABLE `gns_path_technology` ADD INDEX `id_path` (`id_path`)
	    ");

	    $this->execute("
			ALTER TABLE gns_path_technology  ADD CONSTRAINT `gns_path_technology_t` FOREIGN KEY (`id_technology`) REFERENCES `gns_technology` (`id`)
			ON DELETE CASCADE ON UPDATE CASCADE
	    ");
	    
	    $this->execute("
			ALTER TABLE gns_path_technology  ADD CONSTRAINT `gns_path_technology_p` FOREIGN KEY (`id_path`) REFERENCES `gns_path` (`id`)
			ON DELETE CASCADE ON UPDATE CASCADE
	    ");

	}

	public function down()
	{
		$this->dropTable('gns_path_technology');
		$this->dropTable('gns_path');
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