<?php
session_start();
include 'includes/connect.php';
include 'includes/wallet.php';

if($_SESSION['customer_sid']==session_id())
{
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Domino's Style Food Ordering</title>
  
  <!-- Materialize CSS -->
  <link href="css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  
  <!-- Custom Domino's Style CSS -->
  <style>
    .hero-section {
      background: linear-gradient(135deg, #e74c3c, #c0392b);
      color: white;
      padding: 60px 0;
      text-align: center;
    }
    
    .hero-section h1 {
      font-size: 3.5rem;
      font-weight: bold;
      margin-bottom: 20px;
      text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .hero-section p {
      font-size: 1.2rem;
      margin-bottom: 30px;
    }
    
    .food-category {
      margin: 40px 0;
    }
    
    .category-title {
      font-size: 2rem;
      color: #e74c3c;
      margin-bottom: 30px;
      text-align: center;
      font-weight: bold;
    }
    
    .food-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      margin-bottom: 30px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .food-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    }
    
    .food-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      background: #f5f5f5;
    }
    
    .food-info {
      padding: 20px;
    }
    
    .food-name {
      font-size: 1.3rem;
      font-weight: bold;
      color: #2c3e50;
      margin-bottom: 10px;
    }
    
    .food-price {
      font-size: 1.5rem;
      color: #e74c3c;
      font-weight: bold;
      margin-bottom: 15px;
    }
    
    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    
    .qty-btn {
      background: #e74c3c;
      color: white;
      border: none;
      width: 35px;
      height: 35px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 1.2rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    
    .qty-btn:hover {
      background: #c0392b;
    }
    
    .qty-input {
      width: 60px;
      text-align: center;
      border: 2px solid #e74c3c;
      border-radius: 5px;
      padding: 5px;
      font-weight: bold;
    }
    
    .cart-summary {
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      background: #2c3e50;
      color: white;
      padding: 15px;
      text-align: center;
      box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
      z-index: 1000;
    }
    
    .cart-total {
      font-size: 1.3rem;
      font-weight: bold;
      margin-bottom: 10px;
    }
    
    .checkout-btn {
      background: #e74c3c;
      color: white;
      padding: 12px 30px;
      border: none;
      border-radius: 25px;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    
    .checkout-btn:hover {
      background: #c0392b;
    }
    
    .wallet-balance {
      background: #27ae60;
      color: white;
      padding: 10px 20px;
      border-radius: 20px;
      display: inline-block;
      margin-bottom: 20px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar-color">
    <div class="nav-wrapper container">
      <a href="#" class="brand-logo">🍕 Domino's Style</a>
      <ul class="right">
        <li><span class="wallet-balance">💰 Wallet: ₹<?php echo $balance; ?></span></li>
        <li><a href="routers/logout.php">Logout</a></li>
      </ul>
    </div>
  </nav>

  <!-- Hero Section -->
  <div class="hero-section">
    <div class="container">
      <h1>🍕 Delicious Food Delivery</h1>
      <p>Order your favorite food and get it delivered hot and fresh!</p>
    </div>
  </div>

  <!-- Food Categories -->
  <div class="container">
    <!-- Pizzas -->
    <div class="food-category">
      <h2 class="category-title">🍕 Pizzas</h2>
      <div class="row">
        <?php
        $result = mysqli_query($con, "SELECT * FROM items WHERE name LIKE '%Pizza%' AND deleted = 0 ORDER BY price");
        while($row = mysqli_fetch_array($result)) {
          echo '<div class="col s12 m6 l4">';
          echo '<div class="food-card">';
          echo '<img src="images/food/'.$row["image"].'" alt="'.$row["name"].'" class="food-image" onerror="this.src=\'images/food/default-food.jpg\'">';
          echo '<div class="food-info">';
          echo '<div class="food-name">'.$row["name"].'</div>';
          echo '<div class="food-price">₹'.$row["price"].'</div>';
          echo '<div class="quantity-controls">';
          echo '<button class="qty-btn" onclick="decreaseQty('.$row["id"].')">-</button>';
          echo '<input type="number" class="qty-input" id="qty_'.$row["id"].'" value="0" min="0" max="10" onchange="updateCart()">';
          echo '<button class="qty-btn" onclick="increaseQty('.$row["id"].')">+</button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>

    <!-- Burgers -->
    <div class="food-category">
      <h2 class="category-title">🍔 Burgers</h2>
      <div class="row">
        <?php
        $result = mysqli_query($con, "SELECT * FROM items WHERE name LIKE '%Burger%' AND deleted = 0 ORDER BY price");
        while($row = mysqli_fetch_array($result)) {
          echo '<div class="col s12 m6 l4">';
          echo '<div class="food-card">';
          echo '<img src="images/food/'.$row["image"].'" alt="'.$row["name"].'" class="food-image" onerror="this.src=\'images/food/default-food.jpg\'">';
          echo '<div class="food-info">';
          echo '<div class="food-name">'.$row["name"].'</div>';
          echo '<div class="food-price">₹'.$row["price"].'</div>';
          echo '<div class="quantity-controls">';
          echo '<button class="qty-btn" onclick="decreaseQty('.$row["id"].')">-</button>';
          echo '<input type="number" class="qty-input" id="qty_'.$row["id"].'" value="0" min="0" max="10" onchange="updateCart()">';
          echo '<button class="qty-btn" onclick="increaseQty('.$row["id"].')">+</button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>

    <!-- Pasta -->
    <div class="food-category">
      <h2 class="category-title">🍝 Pasta</h2>
      <div class="row">
        <?php
        $result = mysqli_query($con, "SELECT * FROM items WHERE name LIKE '%Pasta%' AND deleted = 0 ORDER BY price");
        while($row = mysqli_fetch_array($result)) {
          echo '<div class="col s12 m6 l4">';
          echo '<div class="food-card">';
          echo '<img src="images/food/'.$row["image"].'" alt="'.$row["name"].'" class="food-image" onerror="this.src=\'images/food/default-food.jpg\'">';
          echo '<div class="food-info">';
          echo '<div class="food-name">'.$row["name"].'</div>';
          echo '<div class="food-price">₹'.$row["price"].'</div>';
          echo '<div class="quantity-controls">';
          echo '<button class="qty-btn" onclick="decreaseQty('.$row["id"].')">-</button>';
          echo '<input type="number" class="qty-input" id="qty_'.$row["id"].'" value="0" min="0" max="10" onchange="updateCart()">';
          echo '<button class="qty-btn" onclick="increaseQty('.$row["id"].')">+</button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>

    <!-- Sides & Beverages -->
    <div class="food-category">
      <h2 class="category-title">🍟 Sides & Beverages</h2>
      <div class="row">
        <?php
        $result = mysqli_query($con, "SELECT * FROM items WHERE (name LIKE '%Fries%' OR name LIKE '%Wings%' OR name LIKE '%Bread%' OR name LIKE '%Nuggets%' OR name LIKE '%Cola%' OR name LIKE '%Soda%' OR name LIKE '%Shake%') AND deleted = 0 ORDER BY price");
        while($row = mysqli_fetch_array($result)) {
          echo '<div class="col s12 m6 l4">';
          echo '<div class="food-card">';
          echo '<img src="images/food/'.$row["image"].'" alt="'.$row["name"].'" class="food-image" onerror="this.src=\'images/food/default-food.jpg\'">';
          echo '<div class="food-info">';
          echo '<div class="food-name">'.$row["name"].'</div>';
          echo '<div class="food-price">₹'.$row["price"].'</div>';
          echo '<div class="quantity-controls">';
          echo '<button class="qty-btn" onclick="decreaseQty('.$row["id"].')">-</button>';
          echo '<input type="number" class="qty-input" id="qty_'.$row["id"].'" value="0" min="0" max="10" onchange="updateCart()">';
          echo '<button class="qty-btn" onclick="increaseQty('.$row["id"].')">+</button>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
  </div>

  <!-- Cart Summary -->
  <div class="cart-summary" id="cartSummary" style="display: none;">
    <div class="cart-total" id="cartTotal">Total: ₹0</div>
    <button class="checkout-btn" onclick="proceedToCheckout()">🛒 Proceed to Checkout</button>
  </div>

  <!-- Scripts -->
  <script src="js/plugins/jquery-1.11.2.min.js"></script>
  <script src="js/materialize.min.js"></script>
  
  <script>
    let cart = {};
    let itemPrices = {};
    
    // Load item prices
    <?php
    $result = mysqli_query($con, "SELECT id, price FROM items WHERE deleted = 0");
    while($row = mysqli_fetch_array($result)) {
      echo "itemPrices[".$row["id"]."] = ".$row["price"].";";
    }
    ?>
    
    function increaseQty(itemId) {
      const input = document.getElementById('qty_' + itemId);
      if (input.value < 10) {
        input.value = parseInt(input.value) + 1;
        updateCart();
      }
    }
    
    function decreaseQty(itemId) {
      const input = document.getElementById('qty_' + itemId);
      if (input.value > 0) {
        input.value = parseInt(input.value) - 1;
        updateCart();
      }
    }
    
    function updateCart() {
      cart = {};
      let total = 0;
      
      <?php
      $result = mysqli_query($con, "SELECT id FROM items WHERE deleted = 0");
      while($row = mysqli_fetch_array($result)) {
        echo "const qty".$row["id"]." = document.getElementById('qty_".$row["id"]."').value;";
        echo "if (qty".$row["id"]." > 0) {";
        echo "  cart[".$row["id"]."] = qty".$row["id"].";";
        echo "  total += qty".$row["id"]." * itemPrices[".$row["id"]."];";
        echo "}";
      }
      ?>
      
      document.getElementById('cartTotal').textContent = 'Total: ₹' + total;
      
      if (total > 0) {
        document.getElementById('cartSummary').style.display = 'block';
      } else {
        document.getElementById('cartSummary').style.display = 'none';
      }
    }
    
    function proceedToCheckout() {
      // Create form with cart data
      const form = document.createElement('form');
      form.method = 'POST';
      form.action = 'place-order.php';
      
      // Add cart items
      for (let itemId in cart) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = itemId;
        input.value = cart[itemId];
        form.appendChild(input);
      }
      
      // Add description
      const descInput = document.createElement('input');
      descInput.type = 'hidden';
      descInput.name = 'description';
      descInput.value = 'Order from Domino\'s Style Interface';
      form.appendChild(descInput);
      
      document.body.appendChild(form);
      form.submit();
    }
  </script>
</body>
</html>
<?php
}
else
{
    if($_SESSION['admin_sid']==session_id())
    {
        header("location:admin-page.php");		
    }
    else{
        header("location:login.php");
    }
}
?>
