<?php
require __DIR__ . '/autoload.php';


$url = 'https://ru.investing.com/news/forex-news';

//$url = 'https://ru.investing.com/news/forex-news/article-2043944';

$curl = new Parser();

$elements = $curl->parse($url)->query(".//*[@class='largeTitle']/article/a");
//    $imgs[] = $xpath->query("/html/body/div[5]/section/div[4]/article[$i]/a/img");

foreach ($elements as $element) {
    preg_match('\'https\'', $element->getAttribute('href'), $matches);
    if ($matches == null) {
        $link_list[] = 'https://ru.investing.com' . $element->getAttribute('href');
    } else {
        $link_list[] = $element->getAttribute('href');
    }
}

//var_dump($link_list);
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

$obj = new Model();
$obj->insert(['title' => 'bla', 'text' => 'blabla', 'imgsrc' => 'img']);
