This is a web application built with PHP and MySQL, featuring a Sign Up and Sign In page. 

Features:-
1. User Registration
2. Login/Logout Functionality
3. Secure Password Storage using md5()
4. Responsive User Interface

Technologies Used:-
Frontend: HTML, CSS
Backend: PHP
Database: MySQL

STEPS FOR SETUP:
Setup for databases:
1. Download and install phpMyAdmin (XAMPP Control)
2. Start the database in the following order-  Apache-->MySQL
3. Both Apache and MySQL pid and port number will be displayed
4.Click on MySQL Admin

Configure the database:
1. Click on new database
2. Create a database named login-system.
3. Run the following SQL script to set up the users table
4. CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
);

5. Run php Files on a web browser with the following link:
http://localhost:8080/login-system/login.php
