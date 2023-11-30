-- Users Table
CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(500) NOT NULL
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
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

-- Todos Table
CREATE TABLE Todos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT,
    todo TEXT NOT NULL,
    FOREIGN KEY (task_id) REFERENCES Tasks(id)
);

-- Notifications Table
CREATE TABLE Notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    user_id INT,
    task_id INT,
    email TEXT,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (task_id) REFERENCES Tasks(id)
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
    FOREIGN KEY (user_id) REFERENCES Users(id)
);
