-- Recreate database
DROP DATABASE IF EXISTS smartbooks;
CREATE DATABASE smartbooks;

-- Enter database
USE smartbooks;

-- Create user
DROP USER 'administrator'@'localhost';
GRANT ALL ON smartbooks.* TO 'administrator'@'localhost' IDENTIFIED BY 'smartbooks';

-- Create users table
CREATE TABLE users (
    id      INTEGER         NOT NULL    AUTO_INCREMENT,
    email    VARCHAR(96)     NOT NULL,
    password   VARCHAR(96)     NOT NULL,
    username    VARCHAR(96)         NOT NULL,
  
    PRIMARY KEY (id)
) ENGINE=InnoDB; 


-- Insert initial data
INSERT users(email, password, username)
VALUES ("firstemail@gmail.com", "123456", "Adam"),
       ("secondemail@gmail.com", "78910", "Eva");


