-- Create our Brew Haven database
CREATE DATABASE brewhaven_db;
USE brewhaven_db;

-- Create the table for our contacts
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    subject VARCHAR(255),
    message TEXT,
    date_sent DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Table for the newsletter subscriptions
CREATE TABLE newsletter_signups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    date_joined DATETIME DEFAULT CURRENT_TIMESTAMP
);
