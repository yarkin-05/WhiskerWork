-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(500) NULL,
    token TEXT NULL,
    token_expiry DATE NULL,
    creation DATE 
);

-- Task Table
CREATE TABLE Tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE,
    description TEXT,
    progress_bar INT DEFAULT 0,
    user_id INT,
    notification TINYINT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);


-- Notifications Table
CREATE TABLE Notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    user_id INT,
    task_id INT,
    email TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (task_id) REFERENCES Tasks(id) ON DELETE CASCADE
);

-- Rewards Table
CREATE TABLE Rewards (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    black_coins INT DEFAULT 0,
    orange_coins INT DEFAULT 0,
    white_coins INT DEFAULT 0,
    siames_coins INT DEFAULT 0,
    gray INT DEFAULT 0,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE multimedia (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publication_id INT,
    file_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (publication_id) REFERENCES publication_id(id) ON DELETE CASCADE
);