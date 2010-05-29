
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- bp_steps
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bp_steps`;


CREATE TABLE `bp_steps`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`container_id` BIGINT,
	`container_type` SMALLINT,
	`order` INTEGER,
	`name` VARCHAR(27)  NOT NULL,
	`type` VARCHAR(27)  NOT NULL,
	`status` TINYINT  NOT NULL,
	`data` LONGTEXT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- bp_cases
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bp_cases`;


CREATE TABLE `bp_cases`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`process_id` BIGINT  NOT NULL,
	`priority` SMALLINT  NOT NULL,
	`status` TINYINT  NOT NULL,
	`data` LONGTEXT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- bp_step_instances
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bp_step_instances`;


CREATE TABLE `bp_step_instances`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`process_id` BIGINT  NOT NULL,
	`case_id` BIGINT  NOT NULL,
	`step_id` BIGINT  NOT NULL,
	`name` VARCHAR(27)  NOT NULL,
	`type` VARCHAR(27)  NOT NULL,
	`container_instance_id` BIGINT,
	`container_instance_type` SMALLINT,
	`priority` SMALLINT  NOT NULL,
	`status` TINYINT  NOT NULL,
	`data` LONGTEXT,
	PRIMARY KEY (`id`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
