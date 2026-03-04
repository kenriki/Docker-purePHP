<?php
require_once 'config.php';
session_start(); 
header('Content-Type: application/json; charset=utf-8');

$dsn  = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
$user = DB_USER;
$pass = DB_PASS;

$id    = $_POST['id'] ?? null;
$name  = $_POST['name'] ?? null;
$price = $_POST['price'] ?? null;

// name や price が空文字でも更新できるように修正
if (!$id) {
    echo json_encode(["error" => "IDがありません"]);
    exit;
}

try {
    $pdo = new PDO($dsn, $user, $pass);

    $stmt = $pdo->prepare("UPDATE products SET name = ?, price = ? WHERE id = ?");
    $stmt->execute([$name, $price, $id]);

    echo json_encode(["status" => "ok"]);
    error_log("商品編集: id={$id}, name={$name}, price={$price}, user_id={$_SESSION['user_id']}");

} catch (PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}
?>