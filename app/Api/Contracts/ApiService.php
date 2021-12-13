<?php


namespace App\Api\Contracts;


interface ApiService
{
    /**
     * @return array
     */
    public function getData() : array;
}
