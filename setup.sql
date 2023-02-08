CREATE DATABASE IF NOT EXISTS estore;

USE estore;

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
  ('Apple iPhone 8, 64GB, Gold - Unlocked (Renewed)', 'The product is refurbished, fully functional, and in excellent condition. Backed by the 90-day Amazon Renewed Guarantee.
- This pre-owned product has been professionally inspected, tested and cleaned by Amazon qualified vendors. It is not certified by Apple.
- This product is in "Excellent condition". The screen and body show no signs of cosmetic damage visible from 12 inches away.
- This product will have a battery that exceeds 80% capacity relative to new.
- Accessories may not be original, but will be compatible and fully functional. Product may come in generic box.
- Product will come with a SIM removal tool, a charger and a charging cable. Headphone and SIM card are not included.', 'https://m.media-amazon.com/images/I/61rWklq6AOL._AC_UY436_FMwebp_QL65_.jpg', 1499.00),
  ('Google Pixel 7-5G Android Phone - Unlocked Smartphone with Wide Angle Lens and 24-Hour Battery - 128GB - Obsidian', 'Google Pixel 7 is powered by Google Tensor G2; it’s faster, more efficient, and more secure, with the best photo and video quality yet on Pixel[1]
Unlocked Android 5G phone gives you the flexibility to change carriers and choose your own data plan[2]; works with Google Fi, Verizon, T-Mobile, AT&T, and other major carriers
Pixel’s Adaptive Battery can last over 24 hours; when Extreme Battery Saver is turned on, it can last up to 72 hours[3]
The 6.3-inch Pixel 7 display is super sharp, with rich, vivid colors; it’s fast and responsive for smoother gaming, scrolling, and moving between apps[4]', 'https://m.media-amazon.com/images/I/71loUpMg0pL._AC_UY436_FMwebp_QL65_.jpg', 1499.00),
  ('Google Pixel 6 Pro', 'A high-end smartphone with a 6.4-inch OLED display, dual camera system and 5G support', 'https://m.media-amazon.com/images/I/51sOm011dML._AC_UF320,320_SR320,320_.jpg', 999.00),
  ('OnePlus 9 Pro', 'A flagship smartphone with a 6.7-inch Fluid AMOLED display, quad camera system and 5G support', 'https://m.media-amazon.com/images/I/612yrAXpo-L._AC_UY436_FMwebp_QL65_.jpg', 999.00),
  ('Apple MacBook Pro', 'A high-performance laptop with a 16-inch Retina display, Touch Bar and 8-core processors', 'https://m.media-amazon.com/images/I/711RQIGWewL._AC_UY436_FMwebp_QL65_.jpg', 1999.00),
  ('Dell XPS 13', 'A premium laptop with a 13.4-inch UHD+ display, 11th Gen Intel Core processors and Thunderbolt 4', 'https://m.media-amazon.com/images/I/7150w5ZxZ9L._AC_UY436_FMwebp_QL65_.jpg', 1299.00),
  ('Microsoft Surface Laptop 4', 'A premium laptop with a 13.5-inch touchscreen display, 11th Gen Intel Core processors and Windows 10', 'https://m.media-amazon.com/images/I/61lYDihIxqL._AC_UY436_FMwebp_QL65_.jpg', 999.00),
  ('HP Spectre x360', 'A 2-in-1 laptop with a 14-inch FHD display, 11th Gen Intel Core processors and a 360-degree hinge', 'https://m.media-amazon.com/images/I/71vDWHvSfdL._AC_UY436_FMwebp_QL65_.jpg', 999.00),
  ('Bose QuietComfort 35 II', 'Wireless noise-cancelling headphones with Alexa and Google Assistant support', 'https://m.media-amazon.com/images/I/81+jNVOUsJL._AC_UY436_FMwebp_QL65_.jpg', 349.00),
  ('Beats Solo Pro', 'On-ear noise-cancelling headphones with Apple H1 chip and fast fuel technology', 'https://m.media-amazon.com/images/I/519YHkvtutL._AC_UY436_FMwebp_QL65_.jpg', 299.00),
  ('Sony WH-1000XM4', 'Wireless noise-cancelling headphones with Alexa and Google Assistant support and touch controls', 'https://m.media-amazon.com/images/I/71x8gW79x-L._AC_UY436_FMwebp_QL65_.jpg', 349.00),
  ('JBL Flip 5', 'Waterproof portable Bluetooth speaker with powerful bass and up to 12 hours of playtime', 'https://m.media-amazon.com/images/I/71A26Nl9RHL._AC_UY436_FMwebp_QL65_.jpg', 99.00),
  ('Sonos Move', 'Portable smart speaker with Alexa and Google Assistant support, Wi-Fi and Bluetooth connectivity', 'https://m.media-amazon.com/images/I/81lIVPzBtRL._AC_UY436_FMwebp_QL65_.jpg', 399.00),
  ('Amazon Echo Dot', 'Smart speaker with Alexa voice control, perfect for your home or office', 'https://m.media-amazon.com/images/I/6182S7MYC2L._AC_UY436_FMwebp_QL65_.jpg', 49.99),
  ('Google Nest Mini', 'Smart speaker with Google Assistant voice control and powerful bass', 'https://m.media-amazon.com/images/I/811AO7MujvL._AC_UY436_FMwebp_QL65_.jpg', 49.00);
