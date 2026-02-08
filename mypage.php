<?php
require_once 'config.php';

// ログインチェック
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>マイページ</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f8f9fa;
            padding: 40px;
            display: flex;
            justify-content: center;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            font-size: 24px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        .info-box {
            background: #e9ecef;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }

        pre {
            background: #2d2d2d;
            color: #ccc;
            padding: 15px;
            border-radius: 4px;
            font-family: monospace;
        }

        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>マイページ</h1>
        <h2>ようこそ <?php echo $_SESSION['user_name'];
                    ?> 様</h2>
        <p>ユーザ：<?php echo $_SESSION['kengen_name'];
                ?></p>
        <hr>
        <h3>Python実行結果:</h3>
        <pre><?php foreach ($output as $line) {
                    echo $line . "\n";
                } ?></pre> <a href="logout.php">ログアウト</a>
</body>

</html>