CREATE TABLE members(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	fullname VARCHAR(100) NOT NULL,
	photo	VARCHAR(50),
	maiden_name	VARCHAR(100),
	mobile	VARCHAR(15),
	email	VARCHAR(50),
	dob	DATE NOT NULL,
	joining_dt DATE NOT NULL,
	vestation_dt DATE,
	first_commitment_dt DATE,
	final_commitment_dt DATE,
	fathers_name VARCHAR(100) NOT NULL,
	mothers_name VARCHAR(100) NOT NULL,
	father_alive TINYINT,
	mother_alive TINYINT,
	address TEXT,
	home_phone VARCHAR(15),
	home_mobile VARCHAR(15),
	parish VARCHAR(50),
	diocese VARCHAR(30),
	demise_dt DATE,
	leaving_dt DATE,
	mission TINYINT,
	generalate TINYINT,
	community INTEGER,
	updated_by INTEGER,
	updated_on DATE,
	edu_joining VARCHAR(50),
	edu_present VARCHAR(50),
	swiss_visit TINYINT,
	holyland_visit TINYINT,
	family_abroad TINYINT,
	annual_checkups TINYINT,
	health_data TEXT
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
	name	VARCHAR(50)
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
    email VARCHAR(128) NOT NULL
);

CREATE TABLE renewals(
	id INTEGER PRIMARY KEY AUTO_INCREMENT,
	member_id INTEGER NOT NULL,
	renewal_dt DATE NOT NULL,
	place VARCHAR(75),
	CONSTRAINT member_renewals FOREIGN KEY (member_id) REFERENCES members(id) ON DELETE CASCADE ON UPDATE CASCADE
);
