<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAll()
    {
        $result =  $this->categoryRepository->getAll();
        return $this->sendSuccess($result);
    }

    public function store(Request $request)
    {
        $result =  $this->categoryRepository->store($request);
        return $this->sendSuccess($result);
    }

    public function update(Request $request,$id)
    {
        $result =  $this->categoryRepository->updateCategory($id,$request->all());
        return $this->sendSuccess($result);
    }

    public function show($id)
    {
        $result =  $this->categoryRepository->show($id);
        return $this->sendSuccess($result);
    }

    public function delete(Request $request,$id)
    {
        $result =  $this->categoryRepository->delete($id);
        return $this->sendSuccess($result);
    }
}
