ALTER TABLE members ADD COLUMN donate_organs TINYINT AFTER health_data;
ALTER TABLE members ADD COLUMN donate_body TINYINT AFTER donate_organs;
ALTER TABLE members ADD COLUMN donate_pancreas TINYINT AFTER donate_organs;
ALTER TABLE members ADD COLUMN donate_lungs TINYINT AFTER donate_organs;
ALTER TABLE members ADD COLUMN donate_liver TINYINT AFTER donate_organs;
ALTER TABLE members ADD COLUMN donate_heart TINYINT AFTER donate_organs;
ALTER TABLE members ADD COLUMN donate_kidneys TINYINT AFTER donate_organs;
ALTER TABLE members ADD COLUMN donate_eyes TINYINT AFTER donate_organs;

