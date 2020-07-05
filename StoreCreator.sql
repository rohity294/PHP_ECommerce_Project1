DROP DATABASE if exists project1;
CREATE DATABASE project1;
USE project1;
CREATE TABLE address(addressid int AUTO_INCREMENT, unitnumber varchar(20), street varchar(20), city varchar(20), province varchar(20), postalcode varchar(20),assigned varchar(5), PRIMARY KEY(addressid));
CREATE TABLE customer(customerid int AUTO_INCREMENT, customername varchar(20), addressid int,  PRIMARY KEY(customerid), FOREIGN KEY(addressid) REFERENCES address(addressid));
CREATE TABLE login(loginid varchar(20) , password varchar(20),PRIMARY KEY(loginid));
CREATE TABLE products(productid int AUTO_INCREMENT, productname varchar(20), price int, quantity int, PRIMARY KEY(productid));
CREATE TABLE orders(orderid int AUTO_INCREMENT, order_total int, customerid int ,PRIMARY KEY(orderid), FOREIGN KEY(customerid) REFERENCES customer(customerid));
CREATE TABLE orderdetails(orderid int, productid int, FOREIGN KEY(orderid) REFERENCES orders(orderid), FOREIGN KEY(productid) REFERENCES products(productid));
