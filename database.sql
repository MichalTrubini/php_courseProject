CREATE TABLE IF NOT EXISTS users (
    id BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    age TINYINT(3) unsigned NOT NULL,
    social_media_url VARCHAR(255) NOT NULL,
    created_at datetime DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE IF NOT EXISTS transactions(
    id BIGINT(20) unsigned NOT NULL AUTO_INCREMENT,
    description VARCHAR(255) NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    date datetime NOT NULL,
    created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    user_id BIGINT(20) unsigned NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
