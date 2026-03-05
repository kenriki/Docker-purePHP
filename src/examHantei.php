<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>試験結果判定ページ</title>

    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background: #f5f5f5;
            padding: 30px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-box {
            background: white;
            padding: 20px;
            width: 350px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .form-box p {
            margin: 10px 0;
        }

        input[type="text"] {
            width: 95%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #0078d7;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #005fa3;
        }

        .result-box {
            background: white;
            padding: 20px;
            width: 350px;
            margin: 25px auto;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            font-size: 16px;
        }

        .notfound {
            color: #d9534f;
            font-weight: bold;
        }

        .rankA { color: #d9534f; font-weight: bold; }
        .rankB { color: #f0ad4e; font-weight: bold; }
        .rankC { color: #5bc0de; font-weight: bold; }
    </style>
</head>

<body>

<h1>試験結果判定</h1>

<div class="form-box">
    <form action="" method="POST">
        <p>ID：<input type="text" name="userId"></p>
        <p>名前：<input type="text" name="userName"></p>
        <button type="submit">判定する</button>
    </form>
</div>

<?php
$result = array(
    "A101" => array("id" => "0001","name" => "たろう","examNumber" =>60),
    "A102" => array("id" => "0002","name" => "はなこ","examNumber" =>50),
    "A103" => array("id" => "0003","name" => "いちろう","examNumber" =>29),
);

// 入力値（POST → GET の順で優先）
$inputId   = "";
$inputName = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputId   = $_POST["userId"]   ?? "";
    $inputName = $_POST["userName"] ?? "";
}

if ($inputId === "" && isset($_GET["id"])) {
    $inputId = $_GET["id"];
}
if ($inputName === "" && isset($_GET["user"])) {
    $inputName = $_GET["user"];
}

// 入力が空なら終了
if ($inputId === "" && $inputName === "") {
    exit;
}

// 判定処理
$hit = null;

foreach ($result as $person) {
    if ($person["id"] === $inputId && $person["name"] === $inputName) {
        $hit = $person;
        break;
    }
}

echo '<div class="result-box">';

if ($hit === null) {
    echo '<span class="notfound">該当者が見つかりませんでした。</span>';
} else {
    $number = $hit["examNumber"];

    if ($number < 30) {
        $rank = '<span class="rankC">C</span>';
    } elseif ($number < 60) {
        $rank = '<span class="rankB">B</span>';
    } else {
        $rank = '<span class="rankA">A</span>';
    }

    echo "{$hit["name"]} さんは、{$number} 点でランク {$rank} です。";
}

echo '</div>';
?>

</body>
</html>