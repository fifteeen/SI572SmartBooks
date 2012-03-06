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

-- below from Daodao: create Book Table
CREATE TABLE Book(id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY, name VARCHAR(128), ISBN INTEGER, year INTEGER, edition INTEGER, price FLOAT, quantity INTEGER, description TEXT, author VARCHAR(128), course_id INTEGER);

