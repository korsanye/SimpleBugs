<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Install_schema extends CI_Model {


	public function create_tables()
	{
		$dbprefix = $this->db->dbprefix;
				
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."categories` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(64) NOT NULL,
		  `default` tinyint(1) NOT NULL,
		  PRIMARY KEY (`id`)
		);
		";
		
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."issues` (
		  `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `project_id` int(11) NOT NULL,
		  `category_id` int(11) NOT NULL,
		  `priority_id` int(11) NOT NULL,
		  `milestone_id` int(11) NOT NULL,
		  `created_by` int(11) NOT NULL,
		  `assigned_to` int(11) NOT NULL,
		  `title` varchar(255) NOT NULL,
		  `estimate` int(11) NOT NULL DEFAULT '0',
		  `time_spent` int(11) NOT NULL DEFAULT '0',		  
		  `create_date` datetime NOT NULL,
		  `last_update` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		)
		";
		
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."issues_posts` (
		  `id` bigint(20) NOT NULL AUTO_INCREMENT,
		  `issue_id` int(11) NOT NULL,
		  `content` text NOT NULL,
		  `assigned_to` int(11) NOT NULL,
		  `assigned_from` int(11) NOT NULL,
		  `assigned_date` datetime NOT NULL,
		  `first_post` tinyint(1) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`),
		  KEY `issue_id` (`issue_id`)
		);
		";
		
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."milestones` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(128) NOT NULL,
		  `milestone` date NOT NULL,
		  PRIMARY KEY (`id`)
		);
		";
		
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."priorities` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(64) NOT NULL,
		  `sort` int(11) NOT NULL,
		  `default` tinyint(1) NOT NULL,
		  PRIMARY KEY (`id`)
		);
		";
		
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."projects` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `name` varchar(128) NOT NULL,
		  PRIMARY KEY (`id`)
		);
		";
		
		
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."settings` (
		  `name` varchar(64) NOT NULL,
		  `value` varchar(128) NOT NULL
		);
		";
		
		$Q[] = "CREATE TABLE IF NOT EXISTS `".$dbprefix."users` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `username` varchar(128) NOT NULL,
		  `password` varchar(60) NOT NULL,
		  `email` varchar(128) NOT NULL,
		  `reset_password_key` varchar(60) NOT NULL,
		  `remember_me_key` varchar(60) NOT NULL,
		  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
		  `join_date` datetime NOT NULL,
		  `last_activity` datetime NOT NULL,
		  PRIMARY KEY (`id`)
		);
		";
		
		$Q[] = "INSERT INTO `".$dbprefix."priorities` (`name`, `sort`, `default`) VALUES
		('Fix now', 0, 0),
		('Fix if time', 1, 1),
		('Development', 2, 0),
		('Backlog', 3, 0);
		";
		
		
		$Q[] = "INSERT INTO `".$dbprefix."categories` (`name`, `default`) VALUES
		('Bug', 1),
		('Feature', 0);
		";
		
		foreach($Q as $query)
		{
			$this->db->query($query);	
		}
		
		
	}
	
}