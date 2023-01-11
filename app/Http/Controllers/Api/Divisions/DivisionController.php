<?php

namespace App\Http\Controllers\Api\Divisions;

use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Repositories\DivisionRepository;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    protected $divisionRepository;

    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    public function index() {
        try {
            $data = $this->divisionRepository->getAll();

            return ApiResponseHelper::successResponse("Success get data divisions", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }

    public function detail($id) {
        try {
            $data = $this->divisionRepository->findOneOrFail($id);

            return ApiResponseHelper::successResponse("Success get data detail division", $data);
        } catch (\Exception $e) {
            return ApiResponseHelper::errorResponse($e->getMessage(), $e->getCode());
        }
    }
}
