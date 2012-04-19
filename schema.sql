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
INSERT users(id, email, password, username, isAdmin)
VALUES ("1", "firstemail@gmail.com", "123456", "Adam","0"),
       ("2","secondemail@gmail.com", "78910", "Eva", "0"),
       ("3","daodao@umich.edu", "12345", "daodao", "1"),
       ("4","yanqi@umich.edu", "54321","yanqi", "1"),
       ("5", "huilan@umich.edu","00000","huilan", "1");

-- below from Daodao: create Book Table
CREATE TABLE book(id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY, name VARCHAR(128), ISBN INTEGER, year INTEGER, edition INTEGER, price FLOAT, quantity INTEGER, description TEXT, authorln VARCHAR(128), authorfn VARCHAR(128), course_id INTEGER, picture VARCHAR(128), fullName VARCHAR(128));
INSERT book (id, name, ISBN, year, edition, price, quantity, description, authorln, authorfn, course_id, picture, fullName)
VALUES (1,"Calculus", "000001", "1998", "3", "99.00", "3", "Fundamentals of Caculus I, II, and III", "Wolf", "Dick", "323", "imgs/2.jpg", "Dick Wolf"),
       (2, "History of China", "000345", "2010", "11", "34.56", "12", "A throughout introduction of Chinese history from Qin dynasty to Qing dynasty", "Mao", "Zedong", "544", "imgs/1.jpg", "Zedong Mao"),
       (3, "Professional C++", "007834", "2003","7", "138.33", "100","A book as the most comprehensive reference of C++", "Guys","Crazy", "450", "imgs/3.jpg", "Crazy Guys"),
      (4, "Choice Architecture", "384993", "2011", "2", "32.99", "30", "Introduction of decision making process", "Cooper","Erin","617","imgs/4.jpg", "Erin Cooper"),
      (5, "Medival Art: Renessace Time", "999999", "1998", "10", "168.00", "35", "A history that go through most famous work in Renancess time", "Vendi","Leonado","307","imgs/5.jpg", "Leonado Vedi"),
	   (6, "Examples & Explanations: Federal Income Tax, 5th Edition", "0735565333", "2008", "5","37.00","10000", "Using the proven technique of the Examples & Explanations series, this comprehensive guide combines textual material with well-written examples, explanations, and questions to test student comprehension of the materials. ",
	   "Bankman", "Joseph", "620","imgs/6.jpg","Joseph Bankman"),
	   (7, "Options, Futures, and Other Derivatives", "0132777428", "2011", "10", "173.81", "10000", "This introductory text on the futures and options markets is ideal for those with a limited background in mathematics.",
	   "Hull", "John", 580, "imgs/7.jpg","John Hull"),
	   (8, "Programming Python", "0596158106", "2011", "4", "25.44", "10000", "Programming Python will show you how, with in-depth tutorials on the language's primary application domains: system administration, GUIs, and the Web. You'll also explore how Python is used in databases, networking, front-end scripting layers, text processing, and more. ",
	   "Lutz", "Mark", 572, "imgs/8.jpg","Mark Lutz"),
	   (9, "Learning PHP, MySQL, and JavaScript: A Step-By-Step Guide to Creating Dynamic Websites ", "0596157134","2009","1", "23.99", "10000", "Learning PHP, MySQL, and JavaScript explains each technology separately, shows you how to combine them, and introduces valuable web programming concepts, including objects, XHTML, cookies, and session management.",
	   "Nixon","Robin", 572, "imgs/9.jpg","Robin Nixon"),
	   (10, "Arbitrage Theory in Continuous Time", "019957474X", "2009", "3", "55.00","10000", "The book is designed for graduate students and combines necessary mathematical background with a solid economic focus. ", 
	   "Bjork", "Tomas", 552, "imgs/10.jpg","Tomas Bjork"),
	   (11, "A History of the Theory of Investments: My Annotated Bibliography", "0471770566","2006", "1", "57.38", "10000", "This exceptional book provides valuable insights into the evolution of financial economics from the perspective of a major player.",
	   "Rubinstein", "Mark",580, "imgs/11.jpg","Mark Rubinstein")
	   ;

-- below from Yanqi: create table course
create table course(id INT UNSIGNED NOT NULL AUTO_INCREMENT KEY, name varchar(128), description text(1024), num integer, term varchar(128));
INSERT course (id, name, description, num, term)
VALUES ("1", "Chinese History", "a 5000 years long history, what a long and difficult class, tons of names to remember", "544", "Fall 2011"),
      ("2", "Caculus III", "fundamentals of differential equations", "323", "Winter 2012"),
      ("3", "Professional C++", "A book as the most comprehensive reference of C++", "450", "Fall 2012"),
      ("4", "Choice Architecture", "Introduction of decision making process", "617", "Winter 2012"),
      ("5", "Medival Art: Renessace Time", "A history that go through most famous work in Renancess time", "307", "Summer 2012"),
      ("6", "Federal Income Tax", "Accounting", "620", "Summer 2011"),
	  ("7", "Financial Management using Derivatives", "Introduction on the futures and options markets in the finance department", "580", "Spring 2011"),
	  ("8", "Python Programming", "Introduction to programming", 572,"Winter 2011"),
	  ("9", "Financial Engineering I", "Arbitrage pricing theory in continuous time", "552", "Spring 2012");
	  

-- create table shoppingcart
create table shoppingcart(id int unsigned not null auto_increment key,quantity integer,checkout bool,book_id integer,customer_id integer);

-- create table addressbook
create table addressbook(id int unsigned not null auto_increment key, customerln varchar(128), customerfn varchar(128),street varchar(128),city varchar(128), state varchar(128), zip integer, customer_id integer);

-- create table orders
create table orders(id int unsigned not null auto_increment key, addressbook_id integer);

-- create table orderitem
create table orderitem(id int unsigned not null auto_increment key, quantity integer, orders_id integer, book_id integer);