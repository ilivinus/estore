CREATE DATABASE IF NOT EXISTS estore;

CREATE TABLE IF NOT EXISTS  product (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT NOT NULL,
  image VARCHAR(255),
  price DECIMAL(10,2) NOT NULL
);

CREATE TABLE IF NOT EXISTS  comment (
  id INT AUTO_INCREMENT PRIMARY KEY,
  author VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  createdAt DATETIME NOT NULL,
  updatedAt DATETIME NOT NULL,
  productId INT NOT NULL,
  FOREIGN KEY (productId) REFERENCES product(id)
);

INSERT INTO product (title, description, image, price)
VALUES 
  ('Apple iPhone 12 Pro Max', 'The latest iPhone with a 6.7-inch OLED display, triple camera system and 5G support', 'iphone_12_pro_max.jpg', 1499.00),
  ('Samsung Galaxy S21 Ultra', 'A flagship smartphone with a 6.8-inch AMOLED display, quad camera system, and 5G support', 'galaxy_s21_ultra.jpg', 1499.00),
  ('Google Pixel 6 Pro', 'A high-end smartphone with a 6.4-inch OLED display, dual camera system and 5G support', 'pixel_6_pro.jpg', 999.00),
  ('OnePlus 9 Pro', 'A flagship smartphone with a 6.7-inch Fluid AMOLED display, quad camera system and 5G support', 'oneplus_9_pro.jpg', 999.00),
  ('Apple MacBook Pro', 'A high-performance laptop with a 16-inch Retina display, Touch Bar and 8-core processors', 'macbook_pro.jpg', 1999.00),
  ('Dell XPS 13', 'A premium laptop with a 13.4-inch UHD+ display, 11th Gen Intel Core processors and Thunderbolt 4', 'dell_xps_13.jpg', 1299.00),
  ('Microsoft Surface Laptop 4', 'A premium laptop with a 13.5-inch touchscreen display, 11th Gen Intel Core processors and Windows 10', 'surface_laptop_4.jpg', 999.00),
  ('HP Spectre x360', 'A 2-in-1 laptop with a 14-inch FHD display, 11th Gen Intel Core processors and a 360-degree hinge', 'hp_spectre_x360.jpg', 999.00),
  ('Bose QuietComfort 35 II', 'Wireless noise-cancelling headphones with Alexa and Google Assistant support', 'bose_quietcomfort_35_ii.jpg', 349.00),
  ('Beats Solo Pro', 'On-ear noise-cancelling headphones with Apple H1 chip and fast fuel technology', 'beats_solo_pro.jpg', 299.00),
  ('Sony WH-1000XM4', 'Wireless noise-cancelling headphones with Alexa and Google Assistant support and touch controls', 'sony_wh-1000xm4.jpg', 349.00),
  ('JBL Flip 5', 'Waterproof portable Bluetooth speaker with powerful bass and up to 12 hours of playtime', 'jbl_flip_5.jpg', 99.00),
  ('Sonos Move', 'Portable smart speaker with Alexa and Google Assistant support, Wi-Fi and Bluetooth connectivity', 'sonos_move.jpg', 399.00),
  ('Amazon Echo Dot', 'Smart speaker with Alexa voice control, perfect for your home or office', 'amazon_echo_dot.jpg', 49.99),
  ('Google Nest Mini', 'Smart speaker with Google Assistant voice control and powerful bass', 'google_nest_mini.jpg', 49.00);
