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

CREATE TABLE dates{
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_id INT,
    start_date DATE,
    end_date DATE,
    FOREIGN KEY (task_id) REFERENCES tasks(id) ON DELETE CASCADE
}

-- Task Table
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    start_date DATE,
    end_date DATE,
    description TEXT,
    completed TINYINT DEFAULT 0,
    user_id INT,
    importance TEXT,
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
    user_id INT,
    file_path VARCHAR(255) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);