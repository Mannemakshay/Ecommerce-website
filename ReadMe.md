E-Commerce Website Project:
This is a simple PHP-based e-commerce website that includes user registration, login, product listing, and a shopping cart system.
It uses MySQL as the database backend and focuses on basic features suitable for learning or small-scale deployment.

Features:

- User registration and login with secure password hashing
- Product listing with images and descriptions
- Shopping cart with add, update, and remove functionality
- Session-based user authentication
- Admin-ready user table structure

Programming languages:

- PHP (Vanilla PHP)
- MySQL
- HTML/CSS
- Sessions for authentication

📁 Project Structure (Ordered):

1. includes/db.php
➤ Database connection file (reused across files).
2. register.php
➤ User registration form and logic.
3. login.php
➤ User login form and authentication.
4. logout.php
➤ Ends the user session and redirects to login.
5. index1.php
➤ Main page after login showing all available products.
6. cart.php
➤ Shopping cart functionality: add, update, remove items.
7. products.php
➤ Script to insert default product entries into the products table.
8. success.html (optional)
➤ Simple confirmation page after successful registration (used in the now-deleted user_store.php).
9. checkout.php (optional/placeholder)
➤ Page for proceeding to checkout. You can expand it with billing, payment, etc.
10. images/ folder
➤ Stores product images used in the site.
Example files:
download (26).jpeg
download (31).jpeg
download (33).jpeg
shopping (4).webp
logo.png
11. css/cart.css
➤ Optional CSS file for styling the cart page.

Database Setup:

1. Create a database in MySQL:
CREATE DATABASE ecommerce;
2. Creating required tables:
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    role ENUM('user', 'admin') DEFAULT 'user'
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    description TEXT,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

How to Run:

1. Clone the project:
git clone https://github.com/yourusername/ecommerce-php.git
cd ecommerce-php
2. Place it in your XAMPP htdocs or WAMP www folder.
3. Import the SQL tables into MySQL using phpMyAdmin or command line.
4. Start Apache and MySQL in XAMPP/WAMP.
5. Visit http://localhost/ecommerce-php/register.php to register a new user.


