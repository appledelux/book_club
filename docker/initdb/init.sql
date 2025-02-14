-- Book Club SQL Script

CREATE DATABASE IF NOT EXISTS book_club;

USE book_club;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Books Table
CREATE TABLE IF NOT EXISTS books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    book_genre VARCHAR(50) NOT NULL,
    year_published YEAR NOT NULL
);

-- Events Table
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    description TEXT
);

-- Reviews Table
CREATE TABLE IF NOT EXISTS reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_book INT NOT NULL,
    id_user INT NOT NULL,
    comment TEXT NOT NULL,
    date DATE NOT NULL,
    FOREIGN KEY (id_book) REFERENCES books(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);



-- User Creation
INSERT INTO users (username, password) VALUES ('user01', SHA2('1234', 256));
-- Admin Creation
INSERT INTO users (username, password) VALUES ('admin', SHA2('admin1234', 256));

