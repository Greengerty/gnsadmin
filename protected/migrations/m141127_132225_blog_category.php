<?php

class m141127_132225_blog_category extends CDbMigration
{
	public function up()
	{
	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_news_category` (
			  `id` int(11) NOT NULL,
 		      `name` varchar(255) NOT NULL,
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			ALTER TABLE `gns_news_category` ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_news_category` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");	    	    

	}

	public function down()
	{
		$this->dropTable('gns_news_category');
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