<?php
    require_once 'config.php';

    // ログインチェック
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit;
    }

    $result = "";
    for($i=0; $i<=10; $i++){
        //echo '$i=' .$i. '<br>';
        error_log('$i=' .$i);
        if($i == 10){
            $result =  '$iは10になりました';
        }
    } 
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
<p><?php echo $result ?></p>
<button id="loadBtn">データ取得</button>

<!--<table id="jsonTable" class="display" style="width:600px; margin:auto;">
    <thead>
        <tr>
            <th>ID</th>
            <th>商品名</th>
            <th>価格</th>
        </tr>
    </thead>
</table>-->

<div class="table-wrapper">
    <table id="jsonTable" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>商品名</th>
                <th>価格</th>
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
            { data: 'price' }
        ]
    });

    $('#loadBtn').on('click', function () {
        fetch('getdata.php')
            .then(res => res.json())
            .then(json => {
                table.clear();
                table.rows.add(json.data);
                table.draw();
            });
    });

});
</script>

<a href="logout.php">ログアウト</a>
</body>

</html>