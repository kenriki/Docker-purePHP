<h2>配列について</h2>
<p>通常の配列</p>
<?php 
   $list = array();
   $list[] = 10;
   $list[] = 20;
   $list[] = 30;
   echo $list[0] ."<br>";
   echo $list[1] ."<br>";
   echo $list[2] ."<br>";
   echo "<br>";
?>
<p>異なるデータ型を配列で管理</p>
<?php
   $list = array(10,"AAA",3.14);
   echo $list[0] ."<br>";
   echo $list[1] ."<br>";
   echo $list[2] ."<br>";
   echo "<br>";
?>
<p>連想配列1</p>
<pre>キーを指定して値をセットできる</pre>
<?php
   $list = array(
        "id" => "A01",
        "name" => "山田",
        "age" => "22",
   );
   echo $list["id"] ."<br>";
   echo $list["name"] ."<br>";
   echo $list["age"] ."<br>";
   echo "<br>";
?>
<p>連想配列2</p>
<?php
   $list = array(
        "キー1" => "値1",
        "キー2" => "値2",
        "キー3" => "値3",
   );
   echo $list["キー1"] ."<br>";
   echo $list["キー2"] ."<br>";
   echo $list["キー3"] ."<br>";
   echo "<br>";
?>
<p>多次元配列</p>
<?php
   $products = array(
        "A101" => array("id" => "A01","name" => "みかん","price" =>300),
        "A102" => array("id" => "B03","name" => "りんご","price" =>200),
        "B101" => array("id" => "C01","name" => "ぶどう","price" => 200),
   );
   echo "<pre>";
    print_r($products)."<br>";
    print_r("products['".$products["A101"]["id"]."']=".$products["A101"]["name"]."<br>");
    print_r("products['".$products["A102"]["id"]."']=".$products["A102"]["name"]."<br>");
    print_r("products['".$products["B101"]["id"]."']=".$products["B101"]["name"]."<br>");
   echo "</pre>";

?>
<h2>制御構造</h2>
<h3>基本構造</h3>
<p>順次型:1つずつ順番に実行する</p>
<?php
  echo "(1) 条件式trueであれば処理1を実行する。<br>";
  echo "if(条件式1){"." // 条件式がtrueのときに入る<br>";
  echo "&nbsp;&nbsp;処理1;<br>";
  echo "}<br>";
  echo "(2) (1)の条件式falseであれば処理2を実行する。<br>";
  echo "else { // 条件式がfalseのときに入る<br>";
  echo "&nbsp;&nbsp;処理2;<br>";
  echo "}<br>";
  echo " ※ (1)と(2)の間にelse if(条件式2) がある場合もある<br>";

  echo "例題1"."<br>";

  $number = 10;
  if($number % 2 == 0){
    echo "input:". $number."は、偶数"."<br>";
  }else {
    echo "input:". $number."は、奇数"."<br>";
  }

  echo "例題2"."<br>";

  $number = 60;
  if(0<=$number && $number < 30){
    echo "input:". $number."は、ランクC"."<br>";
  }else if(30<=$number && $number < 60){
    echo "input:". $number."は、ランクB"."<br>";
  }else if(60<=$number && $number < 100){
    echo "input:". $number."は、ランクA"."<br>";
  }else {
    echo "input:". $number."は、該当なし"."<br>";
  }
?>
<p>連想配列含んだデータで実施した例</p>
<?php
   echo "例題3"."<br>";
   $result = array(
        "A101" => array("id" => "0001","name" => "たろう","examNumber" =>60),
        "A102" => array("id" => "0002","name" => "はなこ","examNumber" =>50),
        "A103" => array("id" => "0003","name" => "いちろう","examNumber" =>29),
   );

  $number = $result["A101"]["examNumber"];
  if(0<$number && $number < 30){
    echo $result["A101"]["name"]."さんは、".$number."点でランクCの結果です。"."<br>";
  }else if(30<=$number && $number < 60){
    echo $result["A101"]["name"]."さんは、".$number."点でランクBの結果です。"."<br>";
  }else if(60<=$number && $number < 100){
    echo $result["A101"]["name"]."さんは、".$number."点でランクAの結果です。"."<br>";
  }else {
    echo "該当なし、もしくは再試験してください"."<br>";
  }
?>
<p>分岐型:条件により処理の流れが分かれる(ifやswitch)</p>
<p>反復型:条件により処理を複数回繰り返す(forやwhile)</p>


