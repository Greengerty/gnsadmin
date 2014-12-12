<?php

class m141205_122436_tehnology_courses extends CDbMigration
{
	public function up()
	{
	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_technology_course` (
			  `id` int(11) NOT NULL,
			  `id_technology` int(11) NOT NULL,
			  `id_course` int(11) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			ALTER TABLE `gns_technology_course` ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_technology_course` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");	    
	    
	    $this->execute("
			ALTER TABLE `gns_technology_course` ADD INDEX `id_technology` (`id_technology`)
	    ");

	    $this->execute("
			ALTER TABLE `gns_technology_course` ADD INDEX `id_course` (`id_course`)
	    ");

	    $this->execute("
			ALTER TABLE gns_technology_course  ADD CONSTRAINT `gns_technology_course_t` FOREIGN KEY (`id_technology`) REFERENCES `gns_technology` (`id`)
			ON DELETE CASCADE ON UPDATE CASCADE
	    ");
	    
	    $this->execute("
			ALTER TABLE gns_technology_course  ADD CONSTRAINT `gns_technology_course_c` FOREIGN KEY (`id_course`) REFERENCES `gns_courses` (`id`)
			ON DELETE CASCADE ON UPDATE CASCADE
	    ");

	}

	public function down()
	{
		$this->dropTable('gns_technology_course');
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