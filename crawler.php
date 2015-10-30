<?php
require_once 'goutte.phar';

use Goutte\Client;

// 1Goutteオブジェクトの生成
$client = new Client();

$urls = ['http://www.eboshi.co.jp/gelande-guide/todays-eboshi'];
$filters = ['table#wp-table-reloaded-id-21-no-1 td'];
for( $i = 0; $i < count($urls); $i++) {
        $crawler = $client->request('GET', $urls[i]);
        if($crawler) {
                print $filters[$i] . "<br />";
                $crawler->filter('table#wp-table-reloaded-id-21-no-1 td')->each(function($node){
        echo "hello";
        print $node->text()."<br />";
                });
        }
        //print_r($crawler);
}
/*while ($i < size($urls)){
    print $urls[$i]."<br />";
    $i++;
};*/
$crawler = $client->request('GET', urls);

// 3「東京の過去36時間の天気」テーブルを指定
//$dom = $crawler->filteriis;
//print_r ($dom);

$ary = array(); // 「現地時間」、「天気」の保存用
$time = "";     // 「現地時間」の一時保管用
$ix = 0;        // 現在行

// 4テーブルから1行ずつ取得する
$dom->each(function ($node) use (&$ix, &$time, &$ary) {

  // 5「現地時間」を取得する
  if (($ix % 8)==0) {
    $time = $node->text();
  }
  // 6「天気」を取得する
  else if ((($ix-1) % 8)==0) {
    $ary[ $time ] = $node->text();
  }
  $ix++;
});

// 7現地時間、天気を表示する
foreach ($ary as $t => $w){
  echo $t. " ". $w. "<br />";
}
($i+=1);
