<?php
require_once 'goutte.phar';
use Goutte\Client;
// 1Goutteオブジェクトの生成
$client = new Client();
$urls = ['http://www.eboshi.co.jp/gelande-guide/todays-eboshi', 'http://stmary.jp/','http://typhoon.yahoo.co.jp/weather/jp/earthquake/list/'];
$filters = ['table#wp-table-reloaded-id-21-no-1 td','table','div#eqhist'];
for( $i = 0; $i < count($urls); $i++) {
        $crawler = $client->request('GET', $urls[$i]);
        if($crawler) {
                $crawler->filter($filters[$i])->each(function($node){
                    print $node->text()."<br />";
                });
        }
}
?>

