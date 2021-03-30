<?php
require __DIR__ . '/autoload.php';
//ссылка на категорию
$url_category = 'https://ru.investing.com/news/forex-news';
//шаблон пасринга ссылок категории
$link_pattern = ".//*[@class='largeTitle']/article/a";
//шаблоны парсинга статьи
$pattern = [
    'title' => ".//*[@class='articleHeader']",
    'p' => ".//*[@class='WYSIWYG articlePage']/p",
    'img' => ".//*[@class='WYSIWYG articlePage']/div[@class='imgCarousel']/img",
];
//создание объекта парсера
$curl = new Parser();
//пасрим ссылки на статьи со страницы категории
$curl->parse_link($url_category);
//заполняем массив ссылками на новости
$links = $curl->getlinkfromxpath($link_pattern);
var_dump($links);
foreach ($links  as $link){
    //парсим данные
    $curl->parse_link($link);
    $article = $curl->getarticle($pattern);
    var_dump($article);
    //сохраняем в базу
    $obj = new Model();
    $obj->insert(['title' => $article['title'], 'text' => $article['text'], 'imgsrc' => $article['img']]);

}

