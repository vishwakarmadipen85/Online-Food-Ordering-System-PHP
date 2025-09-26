-- Update food items to real Domino's-style menu with images
-- Clear existing items
UPDATE items SET deleted = 1;

-- Insert new food items with image column
-- Assumes 'image' column exists in 'items' table (e.g., VARCHAR(255) for image path or filename)
INSERT INTO items (name, price, deleted, image) VALUES
-- Pizzas
('Margherita Pizza', 199, 0, 'margherita-pizza.jpg'),
('Pepperoni Pizza', 249, 0, 'pepperoni-pizza.jpg'),
('Chicken Tikka Pizza', 299, 0, 'chickentikka-burger.jpg'),
('Veg Supreme Pizza', 279, 0, 'pexels-narda-yescas-724842-1566837.jpg'),
('Farmhouse Pizza', 329, 0, 'pexels-narda-yescas-724842-1566837.jpg'),
('Chicken Dominator Pizza', 399, 0, 'pexels-narda-yescas-724842-1566837.jpg'),

-- Burgers
('Classic Veg Burger', 89, 0, 'classic-veg-burger.jpg'),
('Chicken Burger', 129, 0, 'chicken-burger.jpg'),
('Cheese Burger', 149, 0, 'cheese-burger.jpg'),
('Spicy Chicken Burger', 169, 0, 'hotchessy-burger.jpg'),

-- Pasta
('Creamy Mushroom Pasta', 179, 0, 'pexels-enginakyurt-1437267.jpg'),
('Chicken Penne Pasta', 199, 0, 'paneer-spicy-frankie.jpg'),
('Veg Pasta', 159, 0, 'pexels-enginakyurt-1437267.jpg'),

-- Sides & Appetizers
('French Fries', 79, 0, 'veg-hotdog.jpg'),
('Chicken Wings (6 pcs)', 199, 0, 'vegloaded-sandwich.jpg'),
('Garlic Bread', 89, 0, 'pexels-enginakyurt-1438672.jpg'),
('Chicken Nuggets (8 pcs)', 149, 0, 'lachlan-ross.jpg'),

-- Beverages
('Coca Cola', 45, 0, 'pexels-jonathanborba-2983100.jpg'),
('Fresh Lime Soda', 55, 0, 'pexels-luong-minh-toan-738515407-33926468.jpg'),
('Mango Shake', 89, 0, 'pexels-fox-58267-6063291.jpg'),
('Chocolate Milkshake', 99, 0, 'pexels-farhad-8743859.jpg');

-- Update auto increment to start from 21
ALTER TABLE items AUTO_INCREMENT = 21;
