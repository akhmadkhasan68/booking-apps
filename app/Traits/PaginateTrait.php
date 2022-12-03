<?php 
namespace App\Traits;

use Exception;

trait PaginateTrait
{
    /**
     * @param array $searchable
     * @param object $request
     * @param mixed $query
     * 
     * @return mixed
     */
    public static function make(array $searchable, object $request, $query)
    {
        try {
            $request->sort_by ? $sortBy = $request->sort_by : $sortBy = "id";
            $request->order_by && in_array($request->order_by, ['asc', 'desc']) ? $orderBy = $request->order_by : $orderBy = "desc";
            $request->per_page ? $perPage = $request->per_page : $perPage = 10;
            $request->keyword ? $keyword = $request->keyword : $keyword = null;

            return $query->when(!empty($keyword), function($q) use($keyword, $searchable){
                $q->whereLike($searchable, $keyword);
            })->orderBy($sortBy, $orderBy)->paginate($perPage)->appends($request->toArray());
        } catch (\Exception $e) {
            throw new Exception($e->getMessage(), 500);
        }
    }
}
