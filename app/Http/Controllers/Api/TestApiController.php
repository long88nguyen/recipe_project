<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Services\Category\DeleteCategoryService;
use App\Services\Category\GetCategoryService;
use App\Services\Category\StoreCategoryService;
use App\Services\Category\UpdateCategoryService;
use App\Services\Category\GetCategoryByIdService;
use Illuminate\Http\Request;
use App\Models\Category;


class TestApiController extends ApiController
{
    // protected $getCategoryService;
    // protected $deleteCategoryService;
    // protected $updateCategoryService;
    // protected $getCategoryByIdService;

    public function __construct()
    {
        $this->getCategoryService = app(GetCategoryService::class);
        $this->storeCategoryService = app(StoreCategoryService::class);
        $this->deleteCategoryService = app(DeleteCategoryService::class);
        $this->updateCategoryService = app(UpdateCategoryService::class);
        $this->getCategoryByIdService = app(GetCategoryByIdService::class);
    }

    public function index()
    {
        $result =  $this->getCategoryService->index();
        return $this->sendSuccess($result);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        if($request->file('image'))
        {
            $image=$request->file('image');
            $name =  time().".".$image->getClientOriginalName();
            $image->move(public_path('uploads'),$name);
            $data['image'] = $name;
        }
        $result =  $this->storeCategoryService->store($data);
        return $this->sendSuccess($result);
    }

    public function update(Request $request,$id)
    {
        $result =  $this->updateCategoryService->updateCategory($id,$request->all());
        return $this->sendSuccess($result);
    }

    public function show($id)
    {
        $result =  $this->getCategoryByIdService->show($id);
        return $this->sendSuccess($result);
    }

    public function delete(Request $request,$id)
    {
        $result =  $this->deleteCategoryService->delete($id);
        return $this->sendSuccess($result);
    }
}
