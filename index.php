<?php

$url = 'https://ru.investing.com/news/forex-news';
$link_list = [];
//$url = 'https://ru.investing.com/news/forex-news/article-2043944';
function cURL($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Bot 1.0');
    $html = curl_exec($curl);
    curl_close($curl);

    $domObj = new DOMDocument();
    $domObj->preserveWhiteSpace = false;
    @$domObj->loadHTML($html);
    $xpath = new DOMXpath($domObj);

    return $xpath;
}

$elements = cURL($url)->query(".//*[@class='largeTitle']/article/a");
//    $imgs[] = $xpath->query("/html/body/div[5]/section/div[4]/article[$i]/a/img");

foreach ($elements as $element) {
    preg_match('\'https\'', $element->getAttribute('href'), $matches);
    if ($matches == null) {
        $link_list[] = 'https://ru.investing.com' . $element->getAttribute('href');
    } else {
        $link_list[] = $element->getAttribute('href');
    }
}

var_dump($link_list);
//foreach($imgs as $img){
//    var_dump($img[0]->getAttribute('data-src'));
//    //var_dump($element);
//    //var_dump($element[0]->nodeValue);
//}

//text one article
//$elements = $xpath->query(".//*[@class='WYSIWYG articlePage']/p");
//
//foreach ($elements as $element){
//    print_r($element->textContent);
//}
