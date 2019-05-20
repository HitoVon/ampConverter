<?php
/**
 * Created by PhpStorm.
 * User: fenghaitao
 * Date: 2019-05-19
 * Time: 22:14
 */
//$url = "www.baidu.com";
////$url = $_GET["url"];
//$html = file_get_contents($url);
//echo $html;
//$html = "";
//$lines = file('http://www.github.com/');
//foreach ($lines as $line_num => $line) {
//    $html = $html.$line;
//}
//echo $html;

$ch = curl_init();
$timeout = 10; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL,'http://www.163.com/');
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36');
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$html = curl_exec($ch);
echo $html;
