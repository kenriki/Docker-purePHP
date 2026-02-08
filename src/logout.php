<?php
require_once 'config.php';

// セッション変数を空にする
$_SESSION = [];

// ブラウザのクッキーも無効化
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 42000, '/');
}

// セッション破棄
session_destroy();

header("Location: login.php");
exit;
?>