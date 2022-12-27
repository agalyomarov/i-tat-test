<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryUpsertRequest;
use App\Http\Requests\Api\CategotyDeleteRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all(['id_category as id', 'name']);
        return ['success' => true, 'result' => $categories];
    }

    public function upsert(CategoryUpsertRequest $request)
    {
        try {
            $data = $request->validated();
            if (isset($data['id'])) Category::where('id_category', $data['id'])->update(['name' => $data['name']]);
            else Category::create(['name' => $data['name']]);
            return ['success' => true, 'result' => Category::where('name', $data['name'])->first()->id_category];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function delete(CategotyDeleteRequest $request)
    {
        try {
            $data = $request->validated();
            Category::where('id_category', $data['id'])->delete();
            return ['success' => true];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
