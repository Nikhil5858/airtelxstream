DROP DATABASE IF EXISTS airtelxstream;
CREATE DATABASE airtelxstream;
USE airtelxstream;

/* ===========================
   TABLE: users
   =========================== */
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    is_subscription_active TINYINT(1) NOT NULL DEFAULT 0,
    last_login DATETIME NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users
(id,email,password,name,role,is_active,is_subscription_active,created_at)
VALUES
(1,'admin@airtelxstream.com',
'$2y$10$Qw8z7sPZqkJ0x7pQ0xjO7e8l0M1W9xV0XHkFz2zR8l7O5yJq',
'Admin User','admin',1,1,NOW()),
(2,'user@airtelxstream.com',
'$2y$10$uK3V8xY6Zq9H4yR8D1x5P0fK2M8E7S1z6NQqJ0A9W',
'Normal User','user',1,0,NOW());

/* ===========================
   TABLE: user_otp
   =========================== */
CREATE TABLE user_otp (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    otp VARCHAR(10),
    expires_at DATETIME,
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

INSERT INTO user_otp VALUES
(1,1,'999999',DATE_ADD(NOW(),INTERVAL 10 MINUTE),NOW()),
(2,2,'111111',DATE_ADD(NOW(),INTERVAL 10 MINUTE),NOW());

/* ===========================
   TABLE: genres
   =========================== */
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

INSERT INTO genres VALUES
(1,'Action'),(2,'Drama'),(3,'Sci-Fi'),(4,'Historical'),
(5,'Thriller'),(6,'Crime'),(7,'Comedy'),(8,'Adventure'),
(9,'Fantasy'),(10,'Biography');

/* ===========================
   TABLE: ott_providers
   =========================== */
CREATE TABLE ott_providers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    logo_url VARCHAR(500),
    is_active TINYINT(1)
);

INSERT INTO ott_providers VALUES
(1,'Netflix','/logos/netflix.png',1),
(2,'Amazon Prime Video','/logos/prime.png',1),
(3,'Disney+ Hotstar','/logos/hotstar.png',1),
(4,'SonyLIV','/logos/sonyliv.png',1),
(5,'Zee5','/logos/zee5.png',1),
(6,'JioCinema','/logos/jiocinema.png',1),
(7,'Hulu','/logos/hulu.png',1),
(8,'HBO Max','/logos/hbomax.png',1),
(9,'Apple TV+','/logos/appletv.png',1),
(10,'Theatrical/Other','/logos/other.png',1);

/* ===========================
   TABLE: movies
   =========================== */
CREATE TABLE movies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    description TEXT,
    release_year INT,
    language VARCHAR(100),
    type VARCHAR(50),
    movie_url VARCHAR(500),
    trailer_url VARCHAR(500),
    banner_url VARCHAR(500),
    poster_url VARCHAR(500),
    created_at DATETIME,
    updated_at DATETIME,
    is_free TINYINT(1),
    ott_id INT,
    is_new_release TINYINT(1),
    is_hierarchy TINYINT(1),
    is_feature TINYINT(1),
    is_banner TINYINT(1),
    genre_id INT,
    FOREIGN KEY (genre_id) REFERENCES genres(id),
    FOREIGN KEY (ott_id) REFERENCES ott_providers(id)
);

INSERT INTO movies VALUES
(1,'Inception','Dream infiltration',2010,'English','movie','i.mp4','i_t.mp4','i_b.jpg','i_p.jpg',NOW(),NOW(),0,1,0,0,1,0,3),
(2,'Interstellar','Space survival',2014,'English','movie','in.mp4','in_t.mp4','in_b.jpg','in_p.jpg',NOW(),NOW(),0,2,0,0,1,0,3),
(3,'RRR','Revolutionary drama',2022,'Telugu','movie','rrr.mp4','rrr_t.mp4','rrr_b.jpg','rrr_p.jpg',NOW(),NOW(),0,10,1,0,1,1,4);

/* ===========================
   TABLE: watchlist
   =========================== */
CREATE TABLE watchlist (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    movie_id INT,
    added_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (movie_id) REFERENCES movies(id)
);

INSERT INTO watchlist VALUES
(1,1,1,NOW()),
(2,2,2,NOW());

/* ===========================
   TABLE: seasons
   =========================== */
CREATE TABLE seasons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    season_number INT,
    episode_number INT,
    genre_id INT,
    ott_id INT,
    release_year VARCHAR(50),
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (genre_id) REFERENCES genres(id),
    FOREIGN KEY (ott_id) REFERENCES ott_providers(id)
);

INSERT INTO seasons VALUES
(1,3,1,4,10,3,'2022');


/* ===========================
   TABLE: episodes
   =========================== */
CREATE TABLE episodes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    season_id INT,
    episode_number INT,
    title VARCHAR(255),
    description TEXT,
    video_url VARCHAR(500),
    created_at DATETIME,
    poster_img VARCHAR(500),
    FOREIGN KEY (season_id) REFERENCES seasons(id)
);

INSERT INTO episodes VALUES
(1,1,1,'RRR BTS','Behind Scenes','rrr_ep.mp4',NOW(),'rrr_ep.jpg');

/* ===========================
   TABLE: subscription
   =========================== */
CREATE TABLE subscription (
    id INT AUTO_INCREMENT PRIMARY KEY,
    plan_name VARCHAR(255),
    price DECIMAL(10,2),
    duration_days INT,
    is_active TINYINT(1),
    created_at DATETIME
);

INSERT INTO subscription VALUES
(1,'Basic Monthly',99,30,1,NOW()),
(2,'Premium Monthly',299,30,1,NOW());

/* ===========================
   TABLE: user_subscription
   =========================== */
CREATE TABLE user_subscription (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    subscription_id INT,
    start_date DATE,
    end_date DATE,
    status VARCHAR(50),
    payment_type VARCHAR(50),
    payment_status VARCHAR(50),
    transaction_number VARCHAR(255),
    is_autorenew TINYINT(1),
    created_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (subscription_id) REFERENCES subscription(id)
);

INSERT INTO user_subscription VALUES
(1,1,2,'2024-01-01','2025-01-01','active','Card','success','TXN_ADMIN',1,NOW()),
(2,2,1,'2024-10-01','2024-10-31','active','UPI','success','TXN_USER',0,NOW());

/* ===========================
   CAST TABLES
   =========================== */
CREATE TABLE `cast` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    profile_image_url VARCHAR(500),
    bio TEXT,
    date_of_birth DATE
);

CREATE TABLE `cast_roles` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255)
);

CREATE TABLE `cast_content` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    cast_id INT,
    cast_roles_id INT,
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (cast_id) REFERENCES `cast`(id),
    FOREIGN KEY (cast_roles_id) REFERENCES `cast_roles`(id)
);

INSERT INTO cast_roles VALUES
(1,'Lead'),(2,'Supporting');

INSERT INTO `cast` VALUES
(1,'Leonardo DiCaprio','/cast/leo.jpg','Actor','1974-11-11'),
(2,'Ram Charan','/cast/ram.jpg','Actor','1985-03-27');

INSERT INTO cast_content VALUES
(1,1,1,1),
(2,3,2,1);
