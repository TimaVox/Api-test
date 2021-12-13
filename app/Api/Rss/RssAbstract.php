<?php


namespace App\Api\Rss;

use Illuminate\Support\Facades\Date;


abstract class RssAbstract
{

    /**
     * @param $url
     * @return array
     * @throws \Exception
     */
    protected function get($url) : array
    {
        if(empty($url))
            throw new \Exception('There is no resource url');

        $xml = new \SimpleXMLElement($url, null, true);
        return $this->toArray($xml);
    }

    /**
     * @param $data
     * @return array
     */
    private function toArray($data) : array
    {
        $json = json_encode($data);
        return  $this->parse(json_decode($json, true));
    }

    /**
     * @param $data
     * @return array
     */
    private function parse($data) : array
    {
        $array = [];
        $array['title'] = $data['channel']['title'];

        foreach ($data['channel']['item'] as $d) {

            $array['items'][] = (object)[
                'img' => $d['enclosure']['@attributes']['url'] ?? '',
                'title' => $d['title'] ?? '',
                'guid' => $d['guid'] ?? '',
                'author' => $d['author'] ?? '',
                'pubDate' => ($d['pubDate']) ? Date::parse($d['pubDate'])->format('d-m-Y H:i') : ''
            ];
        }
        return $array;
    }
}
