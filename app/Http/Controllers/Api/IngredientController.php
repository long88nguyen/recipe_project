<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Ingredient\IngredientRepository;
use Illuminate\Http\Request;

class IngredientController extends ApiController
{
    private $ingredientRepository ;

    public function __construct(IngredientRepository $ingredientRepository)
    {
        return $this->ingredientRepository = $ingredientRepository;
    }

    public function getAll(Request $request){
        $result = $this->ingredientRepository->getAll($request);
        return $this->sendSuccess($result);
    }
}
