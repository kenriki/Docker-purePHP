<?php
require_once 'config.php';
session_start(); 
header('Content-Type: application/json; charset=utf-8');

$dsn  = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
$user = DB_USER;
$pass = DB_PASS;

$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode(["error" => "IDがありません"]);
    exit;
}

try {
    $pdo = new PDO($dsn, $user, $pass);

    $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$id]);

    echo json_encode(["status" => "ok"]);
    error_log("商品削除: id={$id}, user_id={$_SESSION['user_id']}");

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>