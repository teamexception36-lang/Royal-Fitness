-- Create Database
CREATE DATABASE IF NOT EXISTS login_system;

-- Use the new database
USE login_system;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
);

-- Insert a default admin account
INSERT INTO users (username, email, password, role)
VALUES ('admin', 'admin@example.com', MD5('admin123'), 'admin');
