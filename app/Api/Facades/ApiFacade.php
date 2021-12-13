<?php


namespace App\Api\Facades;


class ApiFacade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor() { return 'apiService'; }
}
