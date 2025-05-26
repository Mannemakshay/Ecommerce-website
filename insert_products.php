<?php
include 'include/db.php';

$products = [
    ['Laptop', 45000.99, 'High performance laptop', 'images/download (31).jpeg'],
    ['Smartphone', 22000.50, 'Latest smartphone model', 'images/download (26).jpeg'],
    ['Headphones', 5000.99, 'Noise-cancelling headphones', 'images/download (33).jpeg'],
    ['Shirts', 2000.50, 'Formal shirt', 'images/shopping (4).webp']
];

$stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sdss", $name, $price, $description, $image);

foreach ($products as $product) {
    list($name, $price, $description, $image) = $product;

    $check = $conn->prepare("SELECT id FROM products WHERE name = ?");
    $check->bind_param("s", $name);
    $check->execute();
    $check->store_result();
    if ($check->num_rows === 0) {
        $stmt->execute();
    }
    $check->close();
}

echo "Products inserted successfully.";

$stmt->close();
$conn->close();
?>
