CREATE TABLE `movies` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`titel` VARCHAR(255) NOT NULL COLLATE 'latin1_german1_ci',
	`original_title` VARCHAR(255) NULL DEFAULT NULL,
	`produktionsland` VARCHAR(50) NOT NULL,
	`duration` INT(11) NOT NULL,
	`release_year` YEAR NULL DEFAULT NULL,
	`genre` VARCHAR(128) NOT NULL,
	`director` VARCHAR(100) NOT NULL,
	`screenwriter` VARCHAR(100) NOT NULL,
	`music` VARCHAR(100) NULL DEFAULT NULL,
    `oscars` VARCHAR(10) NOT NULL,
	`fsk` VARCHAR(50) NULL DEFAULT NULL,
	`actors` TEXT NOT NULL,
	`movie_poster` VARCHAR(128) NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB;