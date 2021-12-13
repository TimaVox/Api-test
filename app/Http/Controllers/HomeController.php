<?php

namespace App\Http\Controllers;

use ApiService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class HomeController extends Controller
{
    /**
     * @param null $resource
     */
    public function index($resource = null)
    {
        $currentPage = request()->query('page', 1);
        $data = [];
        if(!is_null($resource)) {
            $apiService = ApiService::getApi($resource);
            $data = $apiService->getData();
        }

        $collectItems = isset($data['items']) ? collect($data['items']) : collect([]);
        $title = $data['title'] ?? __('API');
        $items = $this->customPaginate($collectItems, $currentPage);

        return view('home.index', compact('items', 'title'));

    }

    /**
     * @param null $data
     * @param int $currentPage
     * @return LengthAwarePaginator
     */
    private function customPaginate($data = null, $currentPage = 1)
    {
        $perPage = config('post.per_page');
        $totalData = $data->count();
        $startingPoint = ($currentPage * $perPage) - $perPage;
        $collect = $data->slice($startingPoint, $perPage);

        return new LengthAwarePaginator($collect, $totalData, $perPage, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
    }
}
