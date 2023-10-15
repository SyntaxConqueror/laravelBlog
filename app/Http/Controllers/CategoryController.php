<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create(Request $request) {
        $categoryData = [
            'name' => $request->input('name'),
        ];
        Category::create($categoryData);
        return redirect(session()->previousUrl());
    }

    public function update(Request $request) {
        $category = Category::find($request->get('selectedCategoryId__updateForm'));
        $categoryData = [
            'name' => $request->input('name'),
        ];
        $category->update($categoryData);
        return redirect(session()->previousUrl());
    }

    public function delete(Request $request) {
        $category = Category::find($request->get('selectedTagId__deleteForm'));
        $category->delete();
        return redirect(session()->previousUrl());
    }

    public function getCategoryById(Request $request){
        return Category::find($request->categoryId);
    }
}
