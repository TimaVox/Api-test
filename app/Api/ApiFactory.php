<?php


namespace App\Api;


use App\Api\Contracts\ApiService;

class ApiFactory
{
    public static function getApi(string $id): ApiService
    {
        switch ($id) {
            case "lenta":
                return new LentaRuRssService();
            case "maybelline":
                return new MakeupJsonService();

            default:
                throw new \Exception("Unknown Api");
        }
    }
}
