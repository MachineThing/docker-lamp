CREATE TABLE messages (id int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, sent bigint unsigned NOT NULL, name tinytext NOT NULL, email tinytext, website tinytext, message text NOT NULL);

INSERT INTO messages (sent, name, email, website, message)
VALUES (0, "Mr. Tester", "test@example.com", "example.com", "If you are reading this then you got the messages correctly!");
