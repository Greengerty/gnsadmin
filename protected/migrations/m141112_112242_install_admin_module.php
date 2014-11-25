<?php

class m141112_112242_install_admin_module extends CDbMigration
{
	public function up()
	{
	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_admins` (
			`id` int(11) NOT NULL,
			  `login` varchar(255) NOT NULL,
			  `password` varchar(255) NOT NULL,
			  `name` varchar(255) NOT NULL,
			  `role` varchar(255) NOT NULL,
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			INSERT INTO `gns_admins` (`id`, `login`, `password`, `name`, `role`, `status`) VALUES
			(1, 'admin', '20EAfcH0JSFQY', 'Root', 'root', '1')
	    ");

	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_pages` (
			`id` int(11) NOT NULL,
			  `parent` int(11) NOT NULL,
			  `name` varchar(255) NOT NULL,
			  `url` varchar(255) NOT NULL,
			  `body` text NOT NULL,
			  `controller` varchar(255) NOT NULL,
			  `meta_title` varchar(255) NOT NULL,
			  `meta_description` varchar(255) NOT NULL,
			  `meta_keywords` varchar(255) NOT NULL,
			  `reiting` int(11) NOT NULL DEFAULT '0',
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8
	    ");

	    $this->execute("
			INSERT INTO `gns_pages` (`id`, `parent`, `name`, `url`, `body`, `controller`, `meta_title`, `meta_description`, `meta_keywords`, `reiting`, `status`) VALUES
			(1, 0, 'Главная страница', '/', '', '', '', '', '', 0, '1')
	    ");

	    $this->execute("
			CREATE TABLE IF NOT EXISTS `gns_teachers` (
			`id` int(11) NOT NULL,
			  `name` varchar(255) NOT NULL,
			  `body` text,
			  `img` varchar(255) NOT NULL,
			  `position` varchar(255) NOT NULL,
			  `tags` varchar(255) NOT NULL,
			  `status` enum('0','1') NOT NULL DEFAULT '0'
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8
	    ");


	    $this->execute("
			ALTER TABLE `gns_admins` ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `login` (`login`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_pages`  ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_teachers`  ADD PRIMARY KEY (`id`)
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_teachers` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_admins` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");

	    $this->execute("
	    	ALTER TABLE `gns_pages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT
	    ");

	}

	public function down()
	{
		$this->dropTable('gns_admins');
		$this->dropTable('gns_pages');
		$this->dropTable('gns_teachers');
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