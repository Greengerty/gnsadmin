<?php

class m141125_082624_news_table extends CDbMigration
{
	public function up()
	{

	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_news` (
			`id` int(11) NOT NULL,
			  `name` varchar(255) NOT NULL,
			  `alias` varchar(255) NOT NULL,
			  `body` text,
			  `img` varchar(255) NOT NULL,
			  `sdate` date NOT NULL,
			  `tags` varchar(255) NOT NULL,
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_news`  ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_news` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");

	}

	public function down()
	{
		$this->dropTable('gns_news');
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