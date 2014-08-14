CREATE TABLE `academic_course_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) DEFAULT NULL,
  `title` varchar(75) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
);

CREATE TABLE provinces(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	disabled TINYINT NOT NULL DEFAULT 0
);

CREATE TABLE members(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	`member_no` varchar(32) DEFAULT NULL,
	fullname VARCHAR(100) NOT NULL,
	photo	VARCHAR(50),
	maiden_name	VARCHAR(100),
	mobile	VARCHAR(15),
	email	VARCHAR(50),
	dob	DATE NOT NULL,
	`birth_state` varchar(50) DEFAULT NULL,
	`birth_district` varchar(50) DEFAULT NULL,
  `baptism_dt` date DEFAULT NULL,
  `baptism_place` varchar(100) DEFAULT NULL,
  `confirmation_dt` date DEFAULT NULL,
  `confirmation_place` varchar(100) DEFAULT NULL,
	joining_dt DATE NOT NULL,
	`joining_place` varchar(75) DEFAULT NULL,
	vestition_dt DATE,
	`vestition_place` varchar(75) DEFAULT NULL,
	first_commitment_dt DATE,
	`first_commitment_place` varchar(75) DEFAULT NULL,
	final_commitment_dt DATE,
	`final_commitment_place` varchar(75) DEFAULT NULL,
	fathers_name VARCHAR(100) NOT NULL,
	mothers_name VARCHAR(100) NOT NULL,
	father_alive TINYINT,
	mother_alive TINYINT,
	`num_brothers` int(11) DEFAULT NULL,
  `num_sisters` int(11) DEFAULT NULL,
  `num_priests` int(11) DEFAULT NULL,
  `num_nuns` int(11) DEFAULT NULL,
  `place_family` int(11) DEFAULT NULL,
	address TEXT,
	home_phone VARCHAR(15),
	home_mobile VARCHAR(15),
	mother_tongue integer default null,
	parish VARCHAR(50),
	diocese VARCHAR(30),
	demise_dt DATE,
	leaving_dt DATE,
	`teach_lang` int(11) DEFAULT NULL,
	mission TINYINT,
	generalate TINYINT,
	updated_by INTEGER,
	updated_on DATE,
	edu_joining VARCHAR(50),
	edu_present VARCHAR(50),
	swiss_visit TINYINT,
	holyland_visit TINYINT,
	family_abroad TINYINT,
	annual_checkups TINYINT,
	health_data TEXT,
	province_id INTEGER,
	age_retired INTEGER,
	last_illness_nature VARCHAR(100),
	pension_amt FLOAT,
	decease_dt	DATE,
	decease_time	TIME,
	convent_decease INTEGER,
	funeral_celebrant VARCHAR(100),
	burial_place VARCHAR(100),
	cemetery VARCHAR(100),
	CONSTRAINT member_province FOREIGN KEY (province_id) REFERENCES provinces(id) ON UPDATE CASCADE
);

CREATE TABLE specializations(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name	VARCHAR(50)
);

CREATE TABLE member_spec(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	spec_id INTEGER,
	member_id INTEGER
);

CREATE TABLE siblings(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	fullname	VARCHAR(100),
	phone	VARCHAR(15),
	alive	TINYINT,
	member_id	INTEGER,
	CONSTRAINT member_siblings FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE communities(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name	VARCHAR(50) UNIQUE
);

CREATE TABLE community_terms(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	community_id	INTEGER NOT NULL,
	year_from	INTEGER,
	year_to	INTEGER,
	designation	VARCHAR(75),
	duration	VARCHAR(15),
	member_id	INTEGER NOT NULL,
	CONSTRAINT member_communities FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT community_term FOREIGN KEY (community_id) REFERENCES communities(id) ON UPDATE CASCADE
);

CREATE TABLE outside_service(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	institution	VARCHAR(100),
	year_from	INTEGER,
	year_to	INTEGER,
	designation	VARCHAR(75),
	duration	VARCHAR(15),
	member_id	INTEGER NOT NULL,
	CONSTRAINT member_outside_svc FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE quotes(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	source VARCHAR(50),
	quote	TEXT
);

CREATE TABLE renewal_courses_spiritual(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name	VARCHAR(100),
	year	INTEGER,
	member_id	INTEGER NOT NULL,
	CONSTRAINT member_courses_spiritual FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE renewal_courses_professional(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name	VARCHAR(100),
	year	INTEGER,
	member_id	INTEGER NOT NULL,
	CONSTRAINT member_courses_professional FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE academic_courses(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name	VARCHAR(100),
	institution VARCHAR(150),
	board	VARCHAR(60),
	class	VARCHAR(10),
	certificate_dt	DATE,
	subjects	VARCHAR(100),
	medium	VARCHAR(100),
	remarks	VARCHAR(150),
	member_id	INTEGER NOT NULL,
	CONSTRAINT member_education_courses FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE tbl_user (
	id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(128) NOT NULL,
	password VARCHAR(128) NOT NULL,
	email VARCHAR(128) NOT NULL,
	province_id INTEGER NOT NULL DEFAULT 1,
	CONSTRAINT user_province FOREIGN KEY (province_id) REFERENCES provinces(id) ON UPDATE CASCADE
);

CREATE TABLE renewals(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	member_id INTEGER NOT NULL,
	renewal_dt DATE NOT NULL,
	place VARCHAR(75),
	CONSTRAINT member_renewals FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE travels(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	year INTEGER,
	places VARCHAR(100),
	nature VARCHAR(50),
	member_id INTEGER NOT NULL,
	CONSTRAINT member_travels FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE books_written(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	authors VARCHAR(150),
	year INTEGER,
	title VARCHAR(100),
	publisher VARCHAR(100),
	member_id INTEGER NOT NULL,
	CONSTRAINT member_books FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE multi_field_names(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(50),
	descr VARCHAR(100)
);

CREATE TABLE multi_field_data(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	descr VARCHAR(100),
	member_id INTEGER NOT NULL,
	field_id INTEGER NOT NULL,
	CONSTRAINT member_multi_fields FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT multi_fields_field FOREIGN KEY (field_id) REFERENCES multi_field_names(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `field_names` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `descr` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `field_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `field_id` int(11) NOT NULL,
  `value` varchar(50) NOT NULL,
  `descr` varchar(150) DEFAULT NULL,
  `code` int(11) DEFAULT NULL,
  `pos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `field_value_names` (`field_id`),
  CONSTRAINT `field_value_names` FOREIGN KEY (`field_id`) REFERENCES `field_names` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `spoken_langs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lang_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `spoken_languages` (`lang_id`),
  KEY `member_spoken_langs` (`member_id`),
  CONSTRAINT `member_spoken_langs` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `spoken_languages` FOREIGN KEY (`lang_id`) REFERENCES `field_values` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `living_outside` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year_from` int(11) DEFAULT NULL,
  `year_to` int(11) DEFAULT NULL,
  `institution` varchar(75) DEFAULT NULL,
  `purpose` varchar(100) DEFAULT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_living_outside` (`member_id`),
  CONSTRAINT `member_living_outside` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE separations(
	id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	year_from INTEGER,
	year_to INTEGER,
	nature VARCHAR(100),
	member_id INTEGER NOT NULL,
	CONSTRAINT member_separations FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE user_codes(
	id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
	code VARCHAR(41) UNIQUE,
	purpose VARCHAR(10),
	data	VARCHAR(50),
	created	DATETIME
);
/*
ALTER TABLE members
	ADD COLUMN cemetery VARCHAR(100) AFTER province_id,
	ADD COLUMN burial_place VARCHAR(100) AFTER province_id,
	ADD COLUMN funeral_celebrant VARCHAR(100) AFTER province_id,
	ADD COLUMN convent_decease INTEGER AFTER province_id,
	ADD COLUMN decease_time	TIME AFTER province_id,
	ADD COLUMN decease_dt	DATE AFTER province_id,
	ADD COLUMN last_illness_nature VARCHAR(100) AFTER province_id,
	ADD COLUMN pension_amt FLOAT AFTER province_id,
	ADD COLUMN age_retired INTEGER AFTER province_id
	;
*/
