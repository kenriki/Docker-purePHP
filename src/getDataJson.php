<?php
    require_once 'config.php';
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    // config.php の定数を変数に変換
    $dsn  = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';
    $user = DB_USER;
    $pass = DB_PASS;

    try {
        $pdo = new PDO($dsn, $user, $pass);

        $stmt = $pdo->query("SELECT id, name, price FROM products");
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode(["data" => $data], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

    } catch (PDOException $e) {
        echo json_encode(["error" => $e->getMessage()]);
    }

?>