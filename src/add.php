<?php
require_once 'config.php';
session_start(); 
header('Content-Type: application/json; charset=utf-8');

$dsn  = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
$user = DB_USER;
$pass = DB_PASS;

$name  = $_POST['name'] ?? null;
$price = $_POST['price'] ?? null;

if (!$name || !$price) {
    echo json_encode(["error" => "必要なデータが不足しています"]);
    exit;
}

try {
    $pdo = new PDO($dsn, $user, $pass);

    $stmt = $pdo->prepare("INSERT INTO products (name, price) VALUES (?, ?)");
    $stmt->execute([$name, $price]);

    // ★ログ出力
    error_log("商品追加: name={$name}, price={$price}, user_id={$_SESSION['user_id']}");

    echo json_encode(["status" => "ok"]);

} catch (PDOException $e) {
    error_log("商品追加エラー: " . $e->getMessage());
    echo json_encode(["error" => $e->getMessage()]);
}
?>