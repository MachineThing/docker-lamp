CREATE TABLE messages (id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, sent bigint unsigned NOT NULL, name tinytext NOT NULL, email tinytext, website tinytext, message text NOT NULL);

INSERT INTO messages (sent, name, email, website, message)
VALUES (1, "Mr. Tester", "test@email.com", null, "If you are reading this then you got the messages correctly!");
