<?php

class Parser
{
    public $link_list = [];

    public function parse($url){
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

}