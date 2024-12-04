This is a web application built with PHP and MySQL, featuring a Sign Up and Sign In page. 

Features:-
User Registration
Login/Logout Functionality
Secure Password Storage using md5()
Responsive User Interface

Technologies Used:-
Frontend: HTML, CSS
Backend: PHP
Database: MySQL

STEPS FOR SETUP:
Setup for databases:
Download and install phpMyAdmin (XAMPP Control)
Start the database in the following order-  Apache-->MySQL
Both Apache and MySQL pid and port number will be displayed
Click on MySQL Admin

Configure the database:
Click on new database
Create a database named login-system.
Run the following SQL script to set up the users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

Run php Files on a web browser with the following link:
http://localhost:8080/login-system/login.php
