<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;



class PostController extends Controller
{
    public function __construct() {
        $this->categories = Category::all();
        $this->tags = Tag::all();

    }

    public function index() {
        $posts = Post::all();
        $categories = $this->categories;
        $tags = $this->tags;
        return view('main', compact('posts', 'categories', 'tags'));
    }

    protected function getPostsByParams(Request $request) {
        $categories = $this->categories;
        $tags = $this->tags;

        $category = $request->input('category');
        $selected_tags = $request->input('tags', []);
        session(['selected_tags' => $selected_tags, 'selected_category' => $category]);

        // Use the $category and $tags values to query database for posts
        $category_filtered_posts = $category != null
            ? Post::where('category_id', $category - 1)->get()
            : Post::all();
        $posts = [];

        foreach ($category_filtered_posts as $category_filtered_post){
            $postTags = $category_filtered_post->tags->pluck('id')->toArray();

            // Check if all $selected_tags are present in $postTags
            if (count(array_intersect($selected_tags, $postTags)) === count($selected_tags)) {
                $posts[] = $category_filtered_post;
            }
        }

        return view('main', compact('posts', 'categories', 'tags'));
    }

    protected function getPostsBySearch(Request $request) {
        $categories = $this->categories;
        $tags = $this->tags;

        $post__title = $request->input('post__title');
        $posts = Post::where('title', 'LIKE', '%' . $post__title . '%')->get();

        return view('main', compact('posts', 'categories', 'tags'));
    }

    protected function getAllPosts() {
        $posts = Post::all();
        return $posts;
    }

    protected function createPost(Request $request) {


//        $image = $request->file('postPreview');
//
//        $imageName = time() . '.' . $image->getClientOriginalExtension();
//
//        // Загружаем файл в S3 Bucket
//        Storage::disk('s3')->put($imageName, file_get_contents($image));
//
//        // Вернуть URL загруженного файла
//        $url = Storage::disk('s3')->url($imageName);

        Storage::put('test.txt', 'Hello world!');
        $postData = [
            'title' => $request->input('postTitle'),
            'content' => $request->input('postContent'),
            'category_id' => $request->get('postCategorySelect'),
            'is_published' => $request->input('is_post_published') == "on" ? 1 : 0,
            'preview' => '', // Use the S3 URL here
        ];

        return response()->json($postData);
    }
}
