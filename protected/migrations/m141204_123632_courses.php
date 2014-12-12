<?php

class m141204_123632_courses extends CDbMigration
{
	public function up()
	{
	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_courses` (
			  `id` int(11) NOT NULL,
 		      `name` varchar(255) NOT NULL,
 		      `alias` varchar(255) NOT NULL,
 		      `body` text NOT NULL,
 		      `img` varchar(255) NOT NULL,
 		      `tags` varchar(255) NOT NULL,
 		      `skill_level` varchar(255) NOT NULL,
 		      `price` int(11) NOT NULL,
 		      `articul` varchar(50) NOT NULL,
 		      `exam_id` varchar(50) NOT NULL,
 		      `duration` varchar(50) NOT NULL,
 		      `expert` varchar(255) NOT NULL,
 		      `views` int(11) NOT NULL,
			  `format` enum('day','evening') NOT NULL DEFAULT 'day',
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			ALTER TABLE `gns_courses` ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_courses` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");	    	    

	}

	public function down()
	{
		$this->dropTable('gns_courses');
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