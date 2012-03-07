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
CREATE TABLE book(id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY, name VARCHAR(128), ISBN INTEGER, year INTEGER, edition INTEGER, price FLOAT, quantity INTEGER, description TEXT, authorln VARCHAR(128), authorfn VARCHAR(128), course_id INTEGER);
INSERT book (id, name, ISBN, year, edition, price, quantity, description, authorln, authorfn, course_id)
VALUES ("1", "Calculus", "000001", "1998", "3", "99.00", "3", "Fundamentals of Caculus I, II, and III", "Wolf", "Dick", "323"),
       ("2", "History of China", "000345", "2010", "11", "34.56", "12", "A throughout introduction of Chinese history from Qin dynasty to Qing dynasty", "Mao", "Zedong", "544");

-- below from Yanqi: create table course
create table course(id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY, name varchar(128), description text(1024), num integer, term varchar(128));
INSERT course (id, name, description, num, term)
VALUES ("1", "Chinese History", "a 5000 years long history, what a long and difficult class, tons of names to remember", "544", "Fall 2011"),
      （"2", "Caculus III", "fundamentals of differential equations", "323", "Winter 2012");

-- create table costomer
create table customer(id int unsigned not null auto_increment key,email varchar(128),password varchar(128));
INSERT customer(id, email, password)
VALUES ("1","daodao@umich.edu", "12345"),
      ("2","yanqi@umich.edu", "54321"),
      ("3","huilan@umich.edu","00000");


--create table shoppingcart
create table shoppingcart(id int unsigned not null auto_increment key,quantity integer,checkout bool,book_id integer,customer_id integer);
INSERT shoppingcart(id, quantity, checkout, book_id, customer_id)
VALUES("1","2","0","1","1"),
      ("2","1","0","2","2");


