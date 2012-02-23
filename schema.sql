-- Recreate database
DROP DATABASE IF EXISTS midterm;
CREATE DATABASE midterm;

-- Enter database
USE midterm;

-- Create user
DROP USER 'usermidterm'@'localhost';
GRANT ALL ON midterm.* TO 'usermidterm'@'localhost' IDENTIFIED BY 'usermidtermpass';

-- Create cars table
CREATE TABLE cars (
    id      INTEGER         NOT NULL    AUTO_INCREMENT,
    make    VARCHAR(96)     NOT NULL,
    model   VARCHAR(96)     NOT NULL,
    year    INTEGER         NOT NULL,
    miles   INTEGER         NOT NULL,
    price   INTEGER         NOT NULL,
    
    PRIMARY KEY (id)
) ENGINE=InnoDB; 


-- Insert initial data
INSERT cars(make, model, year, miles, price)
VALUES ("1st Make", "1st Model", 10, 11, 12),
       ("2nd Make", "2nd Model", 20, 21, 22),
       ("3rd Make", "3rd Model", 30, 31, 32),
       ("4th Make", "4th Model", 40, 41, 42);

