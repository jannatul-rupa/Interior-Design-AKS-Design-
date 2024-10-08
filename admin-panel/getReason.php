<?php
session_start();

if (!isset($_SESSION['id']) || $_SESSION['role'] !== 'admin') {
    header("Location: /Project-4800/index.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksviolated_user";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];

    $sql = "SELECT ReasonForDeactivating FROM user WHERE uid = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $reason = $row['ReasonForDeactivating'];
        echo $reason;
    } else {
        echo "Reason not found for user with ID $userId";
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>