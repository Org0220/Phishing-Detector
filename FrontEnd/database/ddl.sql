-- Granting necessary priveleges
-- CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin';
GRANT ALL PRIVILEGES ON anti_phishing_academy.* TO 'admin'@'localhost';

CREATE TABLE users (
    uid INT AUTO_INCREMENT,
    name CHAR(255),
    last_name CHAR(255),
    password CHAR(255),
    PRIMARY KEY (uid)
);

CREATE TABLE results (
    rid INT AUTO_INCREMENT,
    result INT,
    uid INT,
	FOREIGN KEY (uid) REFERENCES users (uid)
		ON DELETE CASCADE,
    PRIMARY KEY (rid)
);