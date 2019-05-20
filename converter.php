<?php
/**
 * Created by PhpStorm.
 * User: fenghaitao
 * Date: 2019-05-19
 * Time: 18:27
 */
require_once (__DIR__.'/vendor/autoload.php');
include_once('simple_html_dom.php');
use Lullabot\AMP\AMP;
use Lullabot\AMP\Validate\Scope;

// Create an AMP object
$amp = new AMP();

$url = $_GET["url"];
//$ch = curl_init();
//$timeout = 10; // set to zero for no timeout
//curl_setopt ($ch, CURLOPT_URL,$url);
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36');
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//file_get_html('http://www.baidu.com/');
global $html;
$html = file_get_html($url);
//$html = curl_exec($ch);
//$html = file_get_contents('$url')
// Notice this is a HTML fragment, i.e. anything that can appear below <body>
//$html =
//    '<p><a href="javascript:run();">Run</a></p>' . PHP_EOL .
//    '<p><a style="margin: 2px;" href="http://www.cnn.com" target="_parent">CNN</a></p>' . PHP_EOL .
//    '<p><a href="http://www.bbcnews.com" target="_blank">BBC</a></p>' . PHP_EOL .
//    '<p><INPUT type="submit" value="submit"></p>' . PHP_EOL .
//    '<p>This is a <div onmouseover="hello();">sample</div> paragraph</p>';

// Load up the HTML into the AMP object
// Note that we only support UTF-8 or ASCII string input and output. (UTF-8 is a superset of ASCII)
//$amp->loadHtml($html);

// If you're feeding it a complete document use the following line instead
$amp->loadHtml($html, ['scope' => Scope::HTML_SCOPE]);

// If you want some performance statistics (see https://github.com/Lullabot/amp-library/issues/24)
// $amp->loadHtml($html, ['add_stats_html_comment' => true]);

// Convert to AMP HTML and store output in a variable
global $amp_html;
$amp_html = $amp->convertToAmpHtml();

// Print AMP HTML
//echo $amp_html;
//echo $html;
//print($amp_html);

// Print validation issues and fixes made to HTML provided in the $html string
//print($amp->warningsHumanText());

// warnings that have been passed through htmlspecialchars() function
// print($amp->warningsHumanHtml());

// You can do the above steps all over again without having to create a fresh object
// $amp->loadHtml($another_string)
// ...
// ...
?>
