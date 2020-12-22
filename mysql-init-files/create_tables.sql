CREATE DATABASE IF NOT EXISTS game_db;
USE game_db;
CREATE TABLE IF NOT EXISTS category
(
    id   INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30)
);
CREATE TABLE IF NOT EXISTS games
(
    id          BIGINT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(60)  NOT NULL,
    description TEXT,
    price       INT          NOT NULL CHECK (price >= 0),
    uri_image   VARCHAR(256) NOT NULL
);
CREATE TABLE IF NOT EXISTS game_category
(
    game_id     BIGINT NOT NULL,
    category_id INT    NOT NULL,
    FOREIGN KEY (game_id) REFERENCES games (id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE TABLE IF NOT EXISTS customers
(
    id    BIGINT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(50) NOT NULL,
    pass  VARCHAR(20) NOT NULL
);
CREATE TABLE IF NOT EXISTS discount
(
    id      INT PRIMARY KEY AUTO_INCREMENT,
    percent INT  NOT NULL CHECK ( percent > 0 && percent < 100 ),
    starts  DATE NOT NULL,
    ends    DATE NOT NULL
);
CREATE TABLE IF NOT EXISTS carts
(
    id          BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    game_price  INT NOT NULL,
    status      ENUM ('taken', 'payed') DEFAULT ('taken'),
    game_id     BIGINT,
    customer_id BIGINT,
    discount_id INT,
    UNIQUE (game_id, customer_id),
    FOREIGN KEY (game_id) REFERENCES games (id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE
        SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (discount_id) REFERENCES discount (id) ON DELETE RESTRICT ON UPDATE CASCADE
);
