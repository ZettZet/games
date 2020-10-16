CREATE TABLE IF NOT EXISTS games(
    game_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(10) NOT NULL,
    dicription TEXT,
    price INT NOT NULL CHECK(price > 0),
    title_image IMAGE NOT NULL
);
CREATE TABLE IF NOT EXISTS customer(
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
);
CREATE TABLE IF NOT EXISTS cart(
    game_id INT NOT NULL,
    cart_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    status_cart BOOLEAN NOT NULL DEFAULT(FALSE),
    FOREIGN KEY (customer_id) REFERENCES customer(customer_id),
    FOREIGN KEY (game_id) REFERENCES games(game_id)
);