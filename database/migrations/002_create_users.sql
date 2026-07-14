CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    branch_id INT UNSIGNED NULL,
    full_name VARCHAR(150) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(150) NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM(
        'OWNER',
        'BRANCH_ADMIN',
        'STOREKEEPER',
        'SALES_ASSISTANT',
        'CASHIER'
    ) NOT NULL,
    status ENUM('ACTIVE', 'INACTIVE') NOT NULL DEFAULT 'ACTIVE',
    last_login_at DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_users_branch
        FOREIGN KEY (branch_id)
        REFERENCES branches(id)
        ON UPDATE CASCADE
        ON DELETE SET NULL
);