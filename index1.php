<?php
session_start();
include __DIR__.'/includes/db.php';
$result = $conn->query("SELECT * FROM products");
$products = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Online Shop</title>
    <style>
        /* Header styling */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #007BFF;
            padding: 8px 20px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.2);
        }

        .logo-container {
            display: flex;
            align-items: center;
        }

        .shop-name {
            font-size: 18px;
            font-weight: bold;
            color: white;
            margin-left: 8px;
        }

        .search-box {
            display: flex;
            border: 2px solid #fff;
            border-radius: 20px;
            overflow: hidden;
            background: white;
        }

        .search-box input {
            border: none;
            padding: 8px 150px;
            font-size: 14px;
            outline: none;
        }

        .search-box button {
            background: #fff;
            color: #007BFF;
            border: none;
            padding: 8px 12px;
            font-size: 14px;
            cursor: pointer;
            transition: 0.3s;
        }

        .user-options {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .user-options a {
            text-decoration: none;
            color: white;
            font-size: 14px;
            font-weight: bold;
            padding: 6px 12px;
            border-radius: 4px;
            background: #0056b3;
            transition: 0.3s;
        }

        .user-options a:hover {
            background-color: #004494;
        }

        /* Product section */
        h2 {
            text-align: center;
            margin-top: 20px;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        .product {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .product img {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        .product h3 {
            margin-bottom: 10px;
        }

        .product button {
            margin-top: 10px;
            background: #007BFF;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }

        .product button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo-container">
            <img src="images/logo.png" alt="logo" height="40" width="40">
            <span class="shop-name">Online Shop</span>
        </div>

        <form class="search-box" action="/search" method="get">
            <input type="search" name="q" placeholder="Search...">
            <button type="submit">Go</button>
        </form>

        <div class="user-options">
            <a href="login.php">Sign In</a>
            <a href="registration.php">Register</a>
            <a href="#">Cart</a>
            <a href="login.php">Logout</a>
        </div>
    </div>

    <h2>Featured Products</h2>
    <div class="products">
        <?php if (empty($products)) : ?>
            <p>No products available.</p>
        <?php else : ?>
            <?php foreach ($products as $product) : ?>
                <div class="product">
                    <h3><?= htmlspecialchars($product['name']); ?></h3>
                    <p>Price: ₹<?= number_format($product['price'], 2); ?></p>
                    <p><?= htmlspecialchars($product['description']); ?></p>
                    <?php if (!empty($product['image'])) : ?>
                        <img src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                    <?php endif; ?>
					<form method="POST" action="cart.php">
					<input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <button type="submit" name="add_to_cart">Add to Cart</button>
					</form>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
