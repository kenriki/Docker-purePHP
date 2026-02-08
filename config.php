<?php
// セッションの開始
session_start();

// DB接続情報
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbcenter'); // phpMyAdminで作ったDB名に変えてください
define('DB_USER', 'root');
define('DB_PASS', 'admin'); // パスワードを設定している場合は入力

// エラー表示設定（開発時のみ。本番では隠す）
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>