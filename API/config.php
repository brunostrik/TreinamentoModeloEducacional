<?php
$host = 'strik.com.br';
$db = 'strikcom_mestrado';
$user = 'strikcom_mestrado';
$pass = '?';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
