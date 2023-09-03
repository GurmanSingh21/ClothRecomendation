<?php
// Start a session to store user data
session_start();

// Sample user data (you will replace this with data from your database)
$users = [
    'user1' => [
        'id' => 1,
        'username' => 'user1',
        'email' => 'user1@example.com',
        'password' => password_hash('password1', PASSWORD_DEFAULT), // Hashed password
        'wishlist' => [101, 102], // Product IDs in the wishlist
        'purchases' => [201], // Product IDs purchased
    ],
    'user2' => [
        'id' => 2,
        'username' => 'user2',
        'email' => 'user2@example.com',
        'password' => password_hash('password2', PASSWORD_DEFAULT),
        'wishlist' => [102, 103],
        'purchases' => [],
    ],
];

// Sample product data (you will replace this with data from your database)
$products = [
    101 => [
        'id' => 101,
        'name' => 'Product A',
        'description' => 'Description of Product A',
    ],
    102 => [
        'id' => 102,
        'name' => 'Product B',
        'description' => 'Description of Product B',
    ],
    103 => [
        'id' => 103,
        'name' => 'Product C',
        'description' => 'Description of Product C',
    ],
];

// Function to authenticate a user
function authenticateUser($username, $password)
{
    global $users;
    if (isset($users[$username]) && password_verify($password, $users[$username]['password'])) {
        $_SESSION['user'] = $users[$username];
        return true;
    }
    return false;
}

// Function to recommend products to the user (collaborative filtering logic here)
function getRecommendations()
{
    // Implement collaborative filtering logic here to generate recommendations
    // You will need to access user's wishlist and purchase history to do this
    // Return an array of recommended product IDs
    return [];
}

// Check if the user is logged in
function isLoggedIn()
{
    return isset($_SESSION['user']);
}

// Logout the user
function logout()
{
    session_destroy();
    header('Location: login.php');
    exit;
}

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (authenticateUser($username, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $loginError = 'Invalid username or password';
    }
}

// Handle logout request
if (isset($_GET['logout'])) {
    logout();
}

// Include this code in your pages to check if the user is logged in
// and to display the recommendations:
/*
if (isLoggedIn()) {
    $recommendations = getRecommendations();
}
*/

?>
