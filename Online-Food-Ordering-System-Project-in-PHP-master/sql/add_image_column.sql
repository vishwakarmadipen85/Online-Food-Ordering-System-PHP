-- Add image column to items table
ALTER TABLE items ADD COLUMN image VARCHAR(255) DEFAULT 'default-food.jpg';

-- Update existing items with image names
UPDATE items SET image = '"C:\Users\Dipen\Downloads\margherita-pizza.jpg.jpg"' WHERE name = 'Margherita Pizza';
UPDATE items SET image = '"C:\Users\Dipen\Downloads\pepperoni-pizza.jpg"' WHERE name = 'Pepperoni Pizza';
UPDATE items SET image = 'chickentikka-burger.jpg' WHERE name = 'Chicken Tikka Burger';

UPDATE items SET image = 'american-burger.jpg' WHERE name = 'American Burger';
UPDATE items SET image = 'pexels-narda-yescas-724842-1566837.jpg' WHERE name = 'Farmhouse Pizza';
UPDATE items SET image = 'pexels-narda-yescas-724842-1566837.jpg' WHERE name = 'Chicken Dominator Pizza';
UPDATE items SET image = 'classic-veg-burger.jpg' WHERE name = 'Classic Veg Burger';
UPDATE items SET image = 'chicken-burger.jpg' WHERE name = 'Chicken Burger';
UPDATE items SET image = 'cheese-burger.jpg' WHERE name = 'Cheese Burger';
UPDATE items SET image = 'hotchessy-burger.jpg' WHERE name = 'Hotchessy Burger';
UPDATE items SET image = 'veg-hotdog.jpg' WHERE name = 'Veg Hotdog';
UPDATE items SET image = 'vegloaded-sandwich.jpg' WHERE name = 'Veg Loaded Sandwich';
UPDATE items SET image = 'pexels-enginakyurt-1437267.jpg' WHERE name = 'Veg Pasta';
UPDATE items SET image = 'paneer-spicy-frankie.jpg' WHERE name = 'Paneer Spicy Frankie';
UPDATE items SET image = 'pexels-enginakyurt-1438672.jpg' WHERE name = 'Cheese Pasta';
UPDATE items SET image = 'lachlan-ross.jpg' WHERE name = 'Lanclan Ross Sandwich';
UPDATE items SET image = 'pexels-tonyleong81-2092906.jpg' WHERE name = 'Veg Cheese Pasta';
UPDATE items SET image = 'pexels-jonathanborba-2983100.jpg' WHERE name = 'Coca Cola';
UPDATE items SET image = 'pexels-luong-minh-toan-738515407-33926468.jpg' WHERE name = 'Fresh Lime Soda';
UPDATE items SET image = 'pexels-fox-58267-6063291.jpg' WHERE name = 'Mango Shake';
UPDATE items SET image = 'pexels-farhad-8743859.jpg' WHERE name = 'Chocolate Milkshake';
