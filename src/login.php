<?php
require_once 'db.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $pdo = get_db_connection();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $user]);
    $row = $stmt->fetch();

    // パスワード照合（本番では password_verify を推奨）
    if ($row && $pass === $row['password']) {
        session_regenerate_id(true); // セッションハイジャック対策
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['username'];
        $_SESSION['kengen_name'] = $row['username'];
        header("Location: mypage.php");
        exit;
    } else {
        $error = "ユーザ名またはパスワードが違います。";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>ログイン</title>
    <style>
        /* UIを整えるCSS */
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5f5;
        }

        .login-card {
            background: white;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 350px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-msg {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <h1>ログインページ</h1>
    <?php if ($error): ?><p style="color:red;"><?php echo $error; ?></p><?php endif; ?>
    <form method="POST">
        ユーザ名: <input type="text" name="username" required><br>
        パスワード: <input type="password" name="password" required><br>
        <button type="submit">ログイン</button>
    </form>
</body>

</html>