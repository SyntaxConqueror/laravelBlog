<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function create(Request $request) {
        $tagData = [
            'name' => $request->input('name'),
        ];

        Tag::create($tagData);
        return redirect(session()->previousUrl());
    }

    public function update(Request $request) {
        $tag = Tag::find($request->get('selectedTagId__updateForm'));

        $tagData = [
            'name' => $request->input('name'),
        ];

        $tag->update($tagData);
        return redirect(session()->previousUrl());
    }

    public function delete(Request $request) {
        $tag = Tag::find($request->get('selectedTagId__deleteForm'));
        $tag->delete();
        return redirect(session()->previousUrl());
    }

    public function getTagById(Request $request){
        return Tag::find($request->tagId);
    }
}
