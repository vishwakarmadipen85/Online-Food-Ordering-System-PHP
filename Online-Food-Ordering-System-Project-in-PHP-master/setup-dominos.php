<?php
include 'includes/connect.php';

echo "<h1>🍕 Setting up Domino's Style Food Ordering System</h1>";

// Step 1: Add image column if it doesn't exist
echo "<h2>Step 1: Adding image column to items table...</h2>";
$result = mysqli_query($con, "SHOW COLUMNS FROM items LIKE 'image'");
if (mysqli_num_rows($result) == 0) {
    mysqli_query($con, "ALTER TABLE items ADD COLUMN image VARCHAR(255) DEFAULT 'default-food.jpg'");
    echo "✅ Image column added successfully!<br>";
} else {
    echo "✅ Image column already exists!<br>";
}

// Step 2: Clear existing items
echo "<h2>Step 2: Clearing existing items...</h2>";
mysqli_query($con, "UPDATE items SET deleted = 1");
echo "✅ Existing items marked as deleted!<br>";

// Step 3: Insert new food items
echo "<h2>Step 3: Adding 20 new food items...</h2>";
$food_items = [
    // Pizzas
    ['Margherita Pizza', 199, 'margherita-pizza.jpg'],
    ['Pepperoni Pizza', 249, 'pepperoni-pizza.jpg'],
    ['Chicken Tikka Pizza', 299, 'chicken-tikka-pizza.jpg'],
    ['Veg Supreme Pizza', 279, 'veg-supreme-pizza.jpg'],
    ['Farmhouse Pizza', 329, 'farmhouse-pizza.jpg'],
    ['Chicken Dominator Pizza', 399, 'chicken-dominator-pizza.jpg'],
    
    // Burgers
    ['Classic Veg Burger', 89, 'classic-veg-burger.jpg'],
    ['Chicken Burger', 129, 'chicken-burger.jpg'],
    ['Cheese Burger', 149, 'cheese-burger.jpg'],
    ['Spicy Chicken Burger', 169, 'spicy-chicken-burger.jpg'],
    
    // Pasta
    ['Creamy Mushroom Pasta', 179, 'creamy-mushroom-pasta.jpg'],
    ['Chicken Penne Pasta', 199, 'chicken-penne-pasta.jpg'],
    ['Veg Pasta', 159, 'veg-pasta.jpg'],
    
    // Sides & Appetizers
    ['French Fries', 79, 'french-fries.jpg'],
    ['Chicken Wings (6 pcs)', 199, 'chicken-wings.jpg'],
    ['Garlic Bread', 89, 'garlic-bread.jpg'],
    ['Chicken Nuggets (8 pcs)', 149, 'chicken-nuggets.jpg'],
    
    // Beverages
    ['Coca Cola', 45, 'coca-cola.jpg'],
    ['Fresh Lime Soda', 55, 'fresh-lime-soda.jpg'],
    ['Mango Shake', 89, 'mango-shake.jpg'],
    ['Chocolate Milkshake', 99, 'chocolate-milkshake.jpg']
];

$stmt = $con->prepare("INSERT INTO items (name, price, image, deleted) VALUES (?, ?, ?, 0)");
$count = 0;

foreach ($food_items as $item) {
    $stmt->bind_param("sds", $item[0], $item[1], $item[2]);
    if ($stmt->execute()) {
        $count++;
        echo "✅ Added: {$item[0]} - ₹{$item[1]}<br>";
    } else {
        echo "❌ Failed to add: {$item[0]}<br>";
    }
}

$stmt->close();
echo "<br><strong>✅ Successfully added {$count} food items!</strong><br>";

// Step 4: Update auto increment
echo "<h2>Step 4: Updating auto increment...</h2>";
mysqli_query($con, "ALTER TABLE items AUTO_INCREMENT = 21");
echo "✅ Auto increment updated!<br>";

echo "<h2>🎉 Setup Complete!</h2>";
echo "<p><strong>Your Domino's Style Food Ordering System is ready!</strong></p>";
echo "<p><a href='admin-page.php' style='background: #e74c3c; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🍕 Go to Admin Panel</a></p>";
echo "<p><a href='customer-menu.php' style='background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🛒 Go to Customer Menu</a></p>";
echo "<p><a href='login.php' style='background: #3498db; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>🔐 Login Page</a></p>";

echo "<h3>📝 Next Steps:</h3>";
echo "<ul>";
echo "<li>Add actual food images to the <code>images/food/</code> folder</li>";
echo "<li>Test the customer ordering interface</li>";
echo "<li>Customize the design and colors</li>";
echo "<li>Add more food categories if needed</li>";
echo "</ul>";

echo "<h3>🖼️ Image Requirements:</h3>";
echo "<ul>";
echo "<li>Size: 400x300 pixels (recommended)</li>";
echo "<li>Format: JPG, PNG, or WebP</li>";
echo "<li>Place images in: <code>images/food/</code> folder</li>";
echo "<li>Use descriptive filenames like: <code>margherita-pizza.jpg</code></li>";
echo "</ul>";
?>
