<?php
define('DB_HOST', 'ps17048.com:3366');
define('DB_SCHEMA', 'ps17048');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $query = "SELECT ps_users.id, ps_users.username FROM ps_users WHERE (username='$username' OR email='$username' OR mobile='$username')  AND admin = 1 LIMIT 1";
    $results = $conn->query($query);
    if ($results->num_rows == 1) {
        $user = $results->fetch_assoc();
        $displayname = $user['username'];
        $userID = $user['id'];
    } else {
        session_destroy();
        unset($_SESSION['username']);
        header('location: ./login.php');
    }
}