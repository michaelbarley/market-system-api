<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function filterData(Request $request, $query)
    {
        foreach ($request->query() as $queryParam => $value) {
            if (!Str::startsWith($queryParam, 'sort_') && $queryParam != 'page' && $queryParam != 'per_page') {
                if (Str::contains($queryParam, '_')) {
                    $queryParam = Str::camel($queryParam);
                }
                $query->where($queryParam, $value);
            }
        }
    
        return $query;
    }
    

    public function sortData(Request $request, $query)
    {
        if ($request->has('sort_by')) {
            $sortOrder = $request->query('order_by', 'asc');
            $query->orderBy($request->query('sort_by'), $sortOrder);
        }

        return $query;
    }

    public function paginateData(Request $request, $query)
    {
        $perPage = $request->query('per_page', 15);

        return $query->paginate($perPage);
    }
}
