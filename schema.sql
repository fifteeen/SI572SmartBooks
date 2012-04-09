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
    username    VARCHAR(96) ,
	isAdmin     INTEGER     NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB; 


-- Insert initial data
INSERT users(email, password, username, isAdmin)
VALUES ("firstemail@gmail.com", "123456", "Adam","1"),
       ("secondemail@gmail.com", "78910", "Eva", "0");

-- below from Daodao: create Book Table
CREATE TABLE book(id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY, name VARCHAR(128), ISBN INTEGER, year INTEGER, edition INTEGER, price FLOAT, quantity INTEGER, description TEXT, authorln VARCHAR(128), authorfn VARCHAR(128), course_id INTEGER);
INSERT book (id, name, ISBN, year, edition, price, quantity, description, authorln, authorfn, course_id)
VALUES ("1", "Calculus", "000001", "1998", "3", "99.00", "3", "Fundamentals of Caculus I, II, and III", "Wolf", "Dick", "323"),
       ("2", "History of China", "000345", "2010", "11", "34.56", "12", "A throughout introduction of Chinese history from Qin dynasty to Qing dynasty", "Mao", "Zedong", "544"),
       ("3", "Professional C++", "007834", "2003","7", "138.33", "100","A book as the most comprehensive reference of C++", "Guys","Crazy", "450"),
      ("4", "Choice Architecture", "384993", "2011", "2", "32.99", "30", "Introduction of decision making process", "Cooper","Erin","617"),
      ("5", "Medival Art: Renessace Time", "999999", "1998", "10", "168.00", "35", "A history that go through most famous work in Renancess time", "Vendi","Leonado","307");

-- below from Yanqi: create table course
create table course(id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY, name varchar(128), description text(1024), num integer, term varchar(128));
INSERT course (id, name, description, num, term)
VALUES ("1", "Chinese History", "a 5000 years long history, what a long and difficult class, tons of names to remember", "544", "Fall 2011"),
      ("2", "Caculus III", "fundamentals of differential equations", "323", "Winter 2012"),
      ("3", "Professional C++", "A book as the most comprehensive reference of C++", "450", "Fall 2012"),
      ("4", "Choice Architecture", "Introduction of decision making process", "617", "Winter 2012"),
      ("5", "Medival Art: Renessace Time", "A history that go through most famous work in Renancess time", "307", "Summer 2012");

-- create table costomer
create table customer(id int unsigned not null auto_increment key,email varchar(128),password varchar(128));
INSERT customer(id, email, password)
VALUES ("1","daodao@umich.edu", "12345"),
      ("2","yanqi@umich.edu", "54321"),
      ("3","huilan@umich.edu","00000");

-- create table shoppingcart
create table shoppingcart(id int unsigned not null auto_increment key,quantity integer,checkout bool,book_id integer,customer_id integer);
INSERT shoppingcart(id, quantity, checkout, book_id, customer_id)
VALUES("1","2","0","1","1"),
      ("2","1","0","2","2");
      
-- drop table address_book
drop table address_book;

--create table addressbook
create table addressbook(id int unsigned not null auto_increment key, customerln varchar(128), customerfn varchar(128),street varchar(128),city varchar(128), state varchar(128), zip integer, customer_id integer);

--create table orders
create table orders(id int unsigned not null auto_increment key, addressbook_id integer);

--create table orderitem
create table orderitem(id int unsigned not null auto_increment key, quantity integer, orders_id integer, book_id integer);