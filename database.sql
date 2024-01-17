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