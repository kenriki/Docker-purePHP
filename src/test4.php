<p>演習1 値渡し</p>
<?php
     function kansu($x){
         $result = 2 * $x;
         return $result;
     }
     $data = kansu(10);
     echo $data;
     
?>
<p>演習2</p>
<?php
     function kansuX(){
         $x = 10;
         $result = 2 * $x;
         return $result;
     }
     $data = kansuX();
     echo $data;
     
?>
<p>演習3</p>
<?php
     function kansuY(){
         $x = 10;
         $data = 2 * $x;
         echo $data;
     }
     $data = kansuY();
     
?>
<p>演習4 参照渡し</p>
<?php
     $data = 10;
     function kansuZ(&$x){
         $data = 2 * $x;
         echo $data;
     }
     $data = kansuZ($data);
     
?>

<p>演習5（解説メッセージ付き）</p>
<?php
     function kansu_PhP1($x=100, $y=200){
         // 渡された引数の数を確認する（おまけ機能）
         $num = func_num_args(); 
         
         if ($num == 0) {
             echo "引数はなかったため、デフォルト値（100, 200）を使いました：";
         } elseif ($num == 1) {
             echo "引数を1つ（{$x}）もらってきました（yはデフォルト値）：";
         } else {
             echo "引数を2つ（{$x}, {$y}）もらってきました：";
         }

         $data = $x + $y;
         echo $data . "<br><br>";
     }

     // 1. 引数なし
     kansu_PhP1(); 

     // 2. 引数1つ
     kansu_PhP1(123); 

     // 3. 引数2つ
     kansu_PhP1(123, 456); 
?>

<pre>
func_num_args() は PHP に最初から備わっている「標準関数」です。特別な設定やインストールなしで、どこでもすぐに使えます。

PHP 4 や 5 の時代からある非常に伝統的な関数で、関数に渡された引数の個数を調べて処理を分けるときによく使われてきました。

せっかくなので、もっと「今風」な書き方も紹介します
最近（PHP 7.0以降）では、func_num_args() を使わなくても、「可変長引数（...）」
という記法を使って、もっと直感的に引数の数を知ることができるようになっています。

もし演習として「引数の数によってメッセージを変えたい」のであれば、こんな書き方もあります：
</pre>

<p>演習5（今風の書き方）</p>
<?php
     // ...$args と書くと、渡された引数が自動的に「配列」にまとめられます
     function kansu_PhP1_Modern(...$args){
         // 1. 引数の数を数える
         $num = count($args); 

         // 2. 引数の数によってメッセージを出し分ける
         if ($num === 0) {
             // 引数がない場合は、自前でデフォルト値を設定して計算
             $x = 100;
             $y = 200;
             echo "引数はなかったため、default値（{$x}, {$y}）を使いました。<br>";
             $data = $x + $y;
         } elseif ($num === 1) {
             // 1つだけもらった場合（$args[0] が最初の引数）
             $x = $args[0];
             $y = 200; // yは固定
             echo "引数1つ（{$x}）をもらってきました。yはdefault値（200）です。<br>";
             $data = $x + $y;
         } else {
             // 2つ以上もらった場合
             echo "引数を {$num} 個もらってきました。<br>";
             // array_sum で配列の中身を全部足し算する！
             $data = array_sum($args);
         }

         // 4. 結果の出力
         echo "計算結果（足し算）： " . $data . "<br><hr>";
     }

     // 実行
     kansu_PhP1_Modern();               // 0個：300
     kansu_PhP1_Modern(123);            // 1個：323
     kansu_PhP1_Modern(123, 456);       // 2個：579
     kansu_PhP1_Modern(10, 20, 30, 40); // 4個でも動く！（合計100）
?>