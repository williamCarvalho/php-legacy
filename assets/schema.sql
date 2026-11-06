CREATE DATABASE IF NOT EXISTS os_management;
USE os_management;

CREATE TABLE IF NOT EXISTS service_orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    value DECIMAL(10,2) NOT NULL,
    status ENUM('P', 'A', 'F', 'C') DEFAULT 'F',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);