<?php
    require_once 'config.php';

    // ログインチェック
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    // $result = "";
    // for($i=0; $i<=10; $i++){
    //     //echo '$i=' .$i. '<br>';
    //     error_log('$i=' .$i);
    //     if($i == 10){
    //         $result =  '$iは10になりました';
    //     }
    // } 
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>
.table-wrapper {
    width: 600px;
    margin: auto;
}
.dt-top, .dt-bottom {
    width: 600px;
    margin: auto;
}
</style>
</head>

<body>
<h1>テストページ</h1>
<!-- <p><?php echo $result ?></p> -->
<button id="loadBtn">データ取得</button>
<button id="addBtn">商品追加</button>

<div class="table-wrapper">
    <table id="jsonTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>価格</th>
                <th>操作</th> 
            </tr>
        </thead>
    </table>
</div>

<script>
$(document).ready(function () {

    let table = $('#jsonTable').DataTable({
        autoWidth: false,
        dom: '<"top"f>rt<"bottom"lip><"clear">',
        data: [],
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'price' },
            {
                data: null,
                render: function(row){
                    return `
                        <button class="editBtn" data-id="${row.id}">編集</button>
                        <button class="deleteBtn" data-id="${row.id}">削除</button>
                    `;
                }
            }
        ]
    });

    $('#loadBtn').on('click', function () {
        fetch('getDataJson.php')
            .then(res => res.json())
            .then(json => {
                table.clear();
                table.rows.add(json.data);
                table.draw();
            });
    });

    // 商品追加ボタンクリック
    $('#addBtn').on('click', function () {
        const name = prompt("商品名を入力してください");
        if (name === null || name === "") return;

        const price = prompt("価格を入力してください");
        if (price === null || price === "") return;

        fetch('add.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `name=${name}&price=${price}`
        })
        .then(res => res.json())
        .then(json => {
            if (json.status === "ok") {
                alert("追加しました");
                $('#loadBtn').click(); // 再読み込み
            } else {
                alert("エラー: " + json.error);
            }
        });
    });

    // 削除ボタンクリック
    $('#jsonTable').on('click', '.deleteBtn', function () {
        const id = $(this).data('id');

        if (!confirm("削除しますか？")) return;

        fetch('delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}`
        })
        .then(res => res.json())
        .then(json => {
            if (json.status === "ok") {
                alert("削除しました");
                $('#loadBtn').click(); // 再読み込み
            } else {
                alert("エラー: " + json.error);
            }
        });
    });

    // 編集ボタンクリック
    $('#jsonTable').on('click', '.editBtn', function () {
        const tr = $(this).closest('tr');
        const row = table.row(tr);
        const rowData = row.data();

        const nameCell = table.cell(tr, 1);
        const priceCell = table.cell(tr, 2);

        // すでに編集モードなら何もしない
        if ($(nameCell.node()).find('input').length > 0) return;

        // input に変換
        nameCell.data(`<input type="text" class="edit-name" value="${rowData.name}">`);
        priceCell.data(`<input type="number" class="edit-price" value="${rowData.price}">`);

        const nameInput = $(nameCell.node()).find('input');
        const priceInput = $(priceCell.node()).find('input');

        nameInput.focus();

        // 保存関数
        function save() {
            const newName = nameInput.val();
            const newPrice = priceInput.val();

            fetch('edit.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${rowData.id}&name=${newName}&price=${newPrice}`
            })
            .then(res => res.json())
            .then(json => {
                if (json.status === "ok") {
                    $('#loadBtn').click();
                    // DataTables の内部データを更新
                    nameCell.data(newName);
                    priceCell.data(newPrice);

                    // 再描画（input が消えて通常表示に戻る）
                    table.draw(false);

                } else {
                    alert("更新エラー: " + json.error);
                }
            });
        }

        // Enter で保存
        nameInput.on('keydown', e => { if (e.key === 'Enter') save(); });
        priceInput.on('keydown', e => { if (e.key === 'Enter') save(); });

        // blur は「両方の input が消えた時だけ」保存する
        let blurCount = 0;
        function handleBlur() {
            blurCount++;
            if (blurCount === 2) save();
        }

        nameInput.on('blur', handleBlur);
        priceInput.on('blur', handleBlur);
    });

});
</script>

<a href="logout.php">ログアウト</a>
</body>

</html>