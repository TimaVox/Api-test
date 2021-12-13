<?php


namespace App\Api;


use App\Api\Contracts\ApiService;
use App\Api\Rss\RssAbstract;


class LentaRuRssService extends RssAbstract implements ApiService
{
    /**
     * Link to source
     * @var string|null
     */
    public ?string $url = 'https://lenta.ru/rss/news';

    /**
     * The method returns an array of processed data and an exception in case of an error.
     * @return array
     * @throws \Exception
     */
    public function getData() : array
    {
        return $this->get($this->url);
    }

}

