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

//$url = $_GET["url"];
$url = "www.baidu.com";
//$ch = curl_init();
//$timeout = 10; // set to zero for no timeout
//curl_setopt ($ch, CURLOPT_URL,$url);
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt ($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.131 Safari/537.36');
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
//file_get_html('http://www.baidu.com/');
global $html;
$html = file_get_html("http://www.baidu.com");
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
$validationText = $amp->warningsHumanText();

// warnings that have been passed through htmlspecialchars() function
$validationHtml = $amp->warningsHumanHtml();

// You can do the above steps all over again without having to create a fresh object
// $amp->loadHtml($another_string)
// ...
// ...
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AMP Converter</title>

    <link rel="stylesheet" href="./static/css/style.css" type="text/css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./static/js/layer/layer.js"></script>
    <script src="./static/js/jquery.js"></script>
    <script>
        function ShowAMP(){
            layer.open({
                type:1,
                title:"AMP",
                area:["395px","300px"],
                content:$("#amp_html"),
            });
        }
    </script>
</head>
<body>
<div class="page">
    <div class="page__demo">
        <form class="search" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
            <div class="a-field search__field">
                <input type="text" id="query" class="r-text-field a-field__input search__input" placeholder="eg: www.baidu.com" required name="url">
                <button class="r-button search__button search__clear" type="reset">
                    <span class="search__clear-label">Clear the search form</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 47.971 47.971" class="search__icon search__icon-clear">
                        <path d="M28.228 23.986L47.092 5.122a2.998 2.998 0 0 0 0-4.242 2.998 2.998 0 0 0-4.242 0L23.986 19.744 5.121.88a2.998 2.998 0 0 0-4.242 0 2.998 2.998 0 0 0 0 4.242l18.865 18.864L.879 42.85a2.998 2.998 0 1 0 4.242 4.241l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879a2.998 2.998 0 0 0 0-4.242L28.228 23.986z" />
                    </svg>
                </button>
                <label class="a-field__label-wrap search__hint" for="query">
                    <span class="a-field__label">Type in the URL of HTML page needed to convert</span>
                </label>
            </div>
            <button class="r-button search__button search__submit" type="submit">
                <span class="search__submit-label">Convert</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 56.966 56.966" class="search__icon search__icon-search">
                    <path d="M55.146 51.887L41.588 37.786A22.926 22.926 0 0 0 46.984 23c0-12.682-10.318-23-23-23s-23 10.318-23 23 10.318 23 23 23c4.761 0 9.298-1.436 13.177-4.162l13.661 14.208c.571.593 1.339.92 2.162.92.779 0 1.518-.297 2.079-.837a3.004 3.004 0 0 0 .083-4.242zM23.984 6c9.374 0 17 7.626 17 17s-7.626 17-17 17-17-7.626-17-17 7.626-17 17-17z" />
                </svg>
            </button>
        </form>
        <span class="page__hint"><a onclick="ShowAMP()">预览</a></span>
        <div id="amp_html"><?php echo $amp_html?></div>
    </div>
    <ul class="nav nav-pills">
        <li role="presentation" class="active"><a href="#">Success</a></li>
        <li role="presentation" class="active"><a href="#">Issues</a></li>
        <li role="presentation" class="active"><a href="#">Fixes</a></li>
    </ul>
    <table class="table detail">
        <thead>
        <tr>
            <th>Tag</th>
            <th>Content</th>
            <th>Line</th>
            <th>Action Taken</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>img</td>
            <td><text><img src="//www.baidu.com/img/baidu_jgylogo3.gif" width="117" height="38" border alt="到百度首页" title="到百度首页"></text></td>
            <td>1</td>
            <td>img tag was converted to the amp-img tag</td>
        </tr>
        <tr>
            <td>img</td>
            <td><text><img src="//www.baidu.com/img/baidu_jgylogo3.gif" width="117" height="38" border alt="到百度首页" title="到百度首页"></text></td>
            <td>1</td>
            <td>img tag was converted to the amp-img tag</td>
        </tr>
        <tr>
            <td>img</td>
            <td><text><img src="//www.baidu.com/img/baidu_jgylogo3.gif" width="117" height="38" border alt="到百度首页" title="到百度首页"></text></td>
            <td>1</td>
            <td>img tag was converted to the amp-img tag</td>
        </tr>
        </tbody>
    </table>
    <div id="validation"><?php $lines = $validationText; foreach ($lines as $line_num => $line ){ echo $line;}?></div>
</div>

<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>
