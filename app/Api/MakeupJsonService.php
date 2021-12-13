<?php

namespace App\Api;

use Cache;
use Date;
use Http;

class MakeupJsonService implements Contracts\ApiService
{
    /**
     * Link to source
     * @var string|null
     */
    public ?string $url = 'https://makeup-api.herokuapp.com/api/v1/products.json?brand=maybelline';

    /**
     * The method caches the data and returns an array of processed data.
     * Throws an exception in case of an error
     * @throws \Exception
     */
    public function getData(): array
    {
        if (!Cache::has('makeup')) {

            $response = Http::get($this->url);
            if(!$response->ok()) {
                throw new \Exception('The service is temporarily unavailable!');
            }
            $products = $this->parse($response->json());
            Cache::add('makeup', $products, 86400);

            return $products;

        } else {
            return Cache::get('makeup');
        }

    }

    /**
     * The method processes the data creates the desired array
     * @param $data
     * @return array
     */
    private function parse($data) : array
    {
        $array = [];
        $array['title'] = __('Maybelline Products');

        foreach ($data as $d) {

            $array['items'][] = (object)[
                'img' => $d['image_link'] ?? '',
                'title' => $d['name'] ?? '',
                'description' => $d['description'] ?? '',
                'guid' => $d['product_link'] ?? '',
                'price' => $d['price'] ?? '',
                'author' => $d['author'] ?? '',
                'pubDate' => ($d['created_at']) ? Date::parse($d['created_at'])->format('d-m-Y H:i') : ''
            ];
        }
        return $array;
    }

}
