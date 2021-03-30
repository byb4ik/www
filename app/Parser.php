<?php

class Parser
{
    /**
     * @var
     */
    public $domobj;
    /**
     * @var
     */
    public $domxpath;
    /**
     * @var array
     */
    public array $links;
    /**
     * @var array
     */
    public array $article;

    /**
     * @param $url
     * @return bool
     */
    public function parse_link($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Bot 1.0');
        $html = curl_exec($curl);
        curl_close($curl);
        $this->domobj = new DOMDocument();
        $this->domobj->preserveWhiteSpace = false;
        @$this->domobj->loadHTML($html);
        $this->domxpath = new DOMXpath($this->domobj);
        return true;
    }

    /**
     * @param string $pattern
     * @return array|null
     */
    public function getlinkfromxpath(string $pattern): ?array
    {
        $elements = $this->domxpath->evaluate($pattern);
        foreach ($elements as $element) {
            preg_match('\'http\'', $element->getAttribute('href'), $matches);
            if ($matches == null) {
                $this->links[] = 'https://ru.investing.com' . $element->getAttribute('href');
            }
        }

        return $this->links;
    }

    /**
     * @param string $pattern
     * @return array|null
     */
    public function getarticle(array $pattern): ?array
    {
        $article = [];
        $title = $this->domxpath->evaluate($pattern['title']);
        foreach ($title as $val) {
            $article['title'] = $val->nodeValue;
        }
        $text = $this->domxpath->evaluate($pattern['p']);
        foreach ($text as $val) {
            $article['text'] .= $val->textContent;
        }
        $img = $this->domxpath->evaluate($pattern['img']);
        foreach ($img as $val) {
            $article['img'] = $val->getAttribute('src');
        }
        return $article;
    }
}