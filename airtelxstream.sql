CREATE DATABASE IF NOT EXISTS airtelxstream;
USE airtelxstream;


/* ===========================
   TABLE: users
   =========================== */
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE,
    name VARCHAR(255),
    created_at DATETIME,
    last_login DATETIME,
    is_subscription_active TINYINT(1)
);

INSERT INTO users (id, email, name, created_at, last_login, is_subscription_active) VALUES
(1,'nikhil@example.com','Nikhil Rathod',NOW(),NOW(),1),
(2,'user2@example.com','User Two',NOW(),NOW(),0),
(3,'user3@example.com','User Three',NOW(),NOW(),0),
(4,'user4@example.com','User Four',NOW(),NOW(),1),
(5,'user5@example.com','User Five',NOW(),NOW(),0),
(6,'user6@example.com','User Six',NOW(),NOW(),0),
(7,'user7@example.com','User Seven',NOW(),NOW(),1),
(8,'user8@example.com','User Eight',NOW(),NOW(),0),
(9,'user9@example.com','User Nine',NOW(),NOW(),1),
(10,'user10@example.com','User Ten',NOW(),NOW(),0);

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

INSERT INTO user_otp (user_id, otp, expires_at, created_at) VALUES
(1,'123456',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(2,'234567',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(3,'345678',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(4,'456789',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(5,'567890',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(6,'111222',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(7,'222333',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(8,'333444',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(9,'444555',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW()),
(10,'555666',DATE_ADD(NOW(), INTERVAL 10 MINUTE),NOW());

/* ===========================
   TABLE: genres
   =========================== */
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

INSERT INTO genres (id, name) VALUES
(1,'Action'),
(2,'Drama'),
(3,'Sci-Fi'),
(4,'Historical'),
(5,'Thriller'),
(6,'Crime'),
(7,'Comedy'),
(8,'Adventure'),
(9,'Fantasy'),
(10,'Biography');

/* ===========================
   TABLE: ott_providers
   =========================== */
CREATE TABLE ott_providers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    logo_url VARCHAR(500),
    is_active TINYINT(1)
);

INSERT INTO ott_providers (id, name, logo_url, is_active) VALUES
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

INSERT INTO movies
(id, title, description, release_year, language, type, movie_url, trailer_url, banner_url, poster_url,
 created_at, updated_at, is_free, ott_id, is_new_release, is_hierarchy, is_feature, is_banner, genre_id)
VALUES
(1,'The Shawshank Redemption',
 'Two imprisoned men bond over decades, finding hope and redemption.',
 1994,'English','movie','shawshank.mp4','shawshank_trailer.mp4','shawshank_banner.jpg','shawshank_poster.jpg',
 NOW(),NOW(),0,10,0,0,1,0,2),

(2,'Inception',
 'A thief who enters dreams must plant an idea to clear his criminal history.',
 2010,'English','movie','inception.mp4','inception_trailer.mp4','inception_banner.jpg','inception_poster.jpg',
 NOW(),NOW(),0,1,0,0,1,0,3),

(3,'Interstellar',
 'Explorers travel through a wormhole in search of a new home for humanity.',
 2014,'English','movie','interstellar.mp4','interstellar_trailer.mp4','interstellar_banner.jpg','interstellar_poster.jpg',
 NOW(),NOW(),0,2,0,0,1,0,3),

(4,'RRR',
 'Two legendary revolutionaries fight the British Raj in this epic drama.',
 2022,'Telugu','movie','rrr.mp4','rrr_trailer.mp4','rrr_banner.jpg','rrr_poster.jpg',
 NOW(),NOW(),0,10,1,0,1,1,4),

(5,'K.G.F: Chapter 2',
 'Rocky rises as a feared ruler while battling powerful enemies.',
 2022,'Kannada','movie','kgf2.mp4','kgf2_trailer.mp4','kgf2_banner.jpg','kgf2_poster.jpg',
 NOW(),NOW(),0,10,1,0,1,1,1),

(6,'3 Idiots',
 'Three students navigate friendship and pressure in an Indian engineering college.',
 2009,'Hindi','movie','3idiots.mp4','3idiots_trailer.mp4','3idiots_banner.jpg','3idiots_poster.jpg',
 NOW(),NOW(),0,2,0,0,1,0,7),

(7,'Joker',
 'A failed comedian transforms into Gotham’s infamous criminal mastermind.',
 2019,'English','movie','joker.mp4','joker_trailer.mp4','joker_banner.jpg','joker_poster.jpg',
 NOW(),NOW(),0,8,0,0,1,0,6),

(8,'Parasite',
 'A poor family cleverly infiltrates the household of a wealthy family.',
 2019,'Korean','movie','parasite.mp4','parasite_trailer.mp4','parasite_banner.jpg','parasite_poster.jpg',
 NOW(),NOW(),0,1,0,0,1,0,2),

(9,'The Dark Knight',
 'Batman faces the Joker, who unleashes chaos upon Gotham City.',
 2008,'English','movie','darkknight.mp4','darkknight_trailer.mp4','darkknight_banner.jpg','darkknight_poster.jpg',
 NOW(),NOW(),0,10,0,0,1,0,6),

(10,'Baahubali 2: The Conclusion',
 'The conclusion of Baahubali reveals betrayal, loyalty, and rightful justice.',
 2017,'Telugu','movie','baahubali2.mp4','baahubali2_trailer.mp4','baahubali2_banner.jpg','baahubali2_poster.jpg',
 NOW(),NOW(),0,10,0,0,1,1,8);

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

INSERT INTO watchlist (user_id, movie_id, added_at) VALUES
(1,2,NOW()),
(1,3,NOW()),
(2,6,NOW()),
(3,1,NOW()),
(4,4,NOW()),
(5,5,NOW()),
(6,7,NOW()),
(7,8,NOW()),
(8,9,NOW()),
(9,10,NOW());

/* ===========================
   TABLE: seasons (not used heavily but required)
   =========================== */
CREATE TABLE seasons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    season_number INT,
    genre_id INT,
    ott_id INT,
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (genre_id) REFERENCES genres(id),
    FOREIGN KEY (ott_id) REFERENCES ott_providers(id)
);

/* OPTIONAL seasons insert (movies are single films) */
INSERT INTO seasons (movie_id, season_number, genre_id, ott_id) VALUES
(4,1,4,10),
(5,1,1,10),
(10,1,8,10);

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

INSERT INTO episodes (season_id, episode_number, title, description, video_url, created_at, poster_img) VALUES
(1,1,'RRR Behind Scenes','Making Of RRR','rrr_ep1.mp4',NOW(),'rrr_ep1.jpg'),
(2,1,'KGF2 Behind Scenes','Making Of KGF2','kgf2_ep1.mp4',NOW(),'kgf2_ep1.jpg'),
(3,1,'Baahubali BTS','Behind the scenes','bahu2_ep1.mp4',NOW(),'bahu2_ep1.jpg');

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

INSERT INTO subscription (id, plan_name, price, duration_days, is_active, created_at) VALUES
(1,'Basic Monthly',99.00,30,1,NOW()),
(2,'Standard Monthly',199.00,30,1,NOW()),
(3,'Premium Monthly',299.00,30,1,NOW()),
(4,'Annual Basic',999.00,365,1,NOW()),
(5,'Annual Premium',1999.00,365,1,NOW()),
(6,'Student Plan',49.00,30,1,NOW()),
(7,'Family Pack',399.00,30,1,NOW()),
(8,'Lite Plan',79.00,30,1,NOW()),
(9,'Ultra HD',499.00,30,1,NOW()),
(10,'Weekend Pass',29.00,7,1,NOW());

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

INSERT INTO user_subscription
(user_id, subscription_id, start_date, end_date, status, payment_type, payment_status, transaction_number, is_autorenew, created_at)
VALUES
(1,3,'2024-10-01','2024-10-31','active','Card','success','TXN1001',1,NOW()),
(2,1,'2024-09-05','2024-10-05','active','UPI','success','TXN1002',0,NOW()),
(3,2,'2024-08-10','2024-09-10','expired','Card','success','TXN1003',0,NOW()),
(4,4,'2024-01-01','2024-12-31','active','NetBanking','success','TXN1004',1,NOW()),
(5,6,'2024-03-01','2024-03-31','expired','UPI','failed','TXN1005',0,NOW()),
(6,5,'2024-02-10','2025-02-10','active','Card','success','TXN1006',1,NOW()),
(7,7,'2024-07-01','2024-07-31','active','Card','success','TXN1007',0,NOW()),
(8,8,'2024-06-01','2024-06-30','expired','UPI','success','TXN1008',0,NOW()),
(9,9,'2024-05-01','2024-05-31','expired','Card','success','TXN1009',0,NOW()),
(10,10,'2024-04-10','2024-04-17','expired','UPI','success','TXN1010',0,NOW());


-- Recreate cast table (note the backticks around the table name `cast`)
CREATE TABLE `cast` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    profile_image_url VARCHAR(500),
    bio TEXT,
    date_of_birth DATE
);

-- Recreate cast_roles table
CREATE TABLE `cast_roles` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255)
);

-- Recreate cast_content table with foreign keys referencing backticked names
CREATE TABLE `cast_content` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    movie_id INT,
    cast_id INT,
    cast_roles_id INT,
    FOREIGN KEY (movie_id) REFERENCES movies(id),
    FOREIGN KEY (cast_id) REFERENCES `cast`(id),
    FOREIGN KEY (cast_roles_id) REFERENCES `cast_roles`(id)
);

-- Insert cast_roles
INSERT INTO `cast_roles` (id, role_name) VALUES
(1,'Lead'),
(2,'Supporting'),
(3,'Antagonist'),
(4,'Cameo'),
(5,'Director');

-- Insert cast (same rows as before)
INSERT INTO `cast` (id, name, profile_image_url, bio, date_of_birth) VALUES
(1,'Tim Robbins','/cast/tim_robbins.jpg','American actor who played Andy Dufresne','1958-10-16'),
(2,'Morgan Freeman','/cast/morgan_freeman.jpg','Played Red in Shawshank','1937-06-01'),
(3,'Leonardo DiCaprio','/cast/leo.jpg','Lead actor in Inception','1974-11-11'),
(4,'Joseph Gordon-Levitt','/cast/jgl.jpg','Played Arthur in Inception','1981-02-17'),
(5,'Elliot Page','/cast/elliot.jpg','Played Ariadne in Inception','1987-02-21'),
(6,'Matthew McConaughey','/cast/matthew.jpg','Played Cooper in Interstellar','1969-11-04'),
(7,'Anne Hathaway','/cast/anne.jpg','Played Amelia Brand','1982-11-12'),
(8,'N. T. Rama Rao Jr.','/cast/jr_ntr.jpg','Played Komaram Bheem in RRR','1983-05-20'),
(9,'Ram Charan','/cast/ram_charan.jpg','Played Alluri Sitarama Raju in RRR','1985-03-27'),
(10,'Alia Bhatt','/cast/alia.jpg','Actress in RRR','1993-03-15'),
(11,'Yash','/cast/yash.jpg','Lead actor in KGF','1986-01-08'),
(12,'Sanjay Dutt','/cast/sanjay_dutt.jpg','Played Adheera','1959-07-29'),
(13,'Aamir Khan','/cast/aamir.jpg','Lead actor in 3 Idiots','1965-03-14'),
(14,'R. Madhavan','/cast/madhavan.jpg','Played Farhan','1970-06-01'),
(15,'Sharman Joshi','/cast/sharman.jpg','Played Raju','1980-03-28'),
(16,'Joaquin Phoenix','/cast/joaquin.jpg','Played Arthur Fleck in Joker','1974-10-28'),
(17,'Zazie Beetz','/cast/zazie.jpg','Played Sophie Dumond','1991-05-25'),
(18,'Song Kang-ho','/cast/song.jpg','Lead actor in Parasite','1967-01-17'),
(19,'Lee Sun-kyun','/cast/lee.jpg','Actor in Parasite','1975-03-02'),
(20,'Christian Bale','/cast/bale.jpg','Played Batman','1974-01-30'),
(21,'Heath Ledger','/cast/ledger.jpg','Played Joker','1979-04-04'),
(22,'Prabhas','/cast/prabhas.jpg','Played Baahubali','1979-10-23'),
(23,'Rana Daggubati','/cast/rana.jpg','Played Bhallaladeva','1984-12-14');

INSERT INTO cast_content (movie_id, cast_id, cast_roles_id) VALUES
(5,11,1),
(5,12,3),

(6,13,1),
(6,14,2),
(6,15,2),

(7,16,1),
(7,17,2),

(8,18,1),
(8,19,2),

(9,20,1),
(9,21,3),

(10,22,1),
(10,23,3);

