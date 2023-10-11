<?php

namespace App\Http\Controllers;

use App\Models\Category;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use GuzzleHttp\Psr7\UploadedFile;
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

    protected function uploadPreview ($preview) {
        $imageName = time() . '.' . $preview->getClientOriginalExtension();

        // Upload file to s3 bucket
        Storage::disk('s3')->put('postPreviews/'.$imageName, file_get_contents($preview));

        // Return uploaded file url
        return Storage::disk('s3')->url($imageName);
    }

    protected function createPost(Request $request) {

        $image = $request->file('postPreview');
        $url = $this->uploadPreview($image);

        $postData = [
            'title' => $request->input('postTitle'),
            'content' => $request->input('postContent'),
            'category_id' => $request->get('postCategorySelect'),
            'is_published' => $request->input('is_post_published') == "on" ? 1 : 0,
            'preview' => $url,
        ];

        Post::create($postData);

        return redirect('http://127.0.0.1:8000/adminPanel/tableWidget?posts');

    }

    protected function updatePost (Request $request) {


        $post = Post::find($request->get('selectedPostId'));

        $preview = $request->file('preview');
        $url = $preview != null ? $this->uploadPreview($preview) : $post->preview;

        $postData = [
            'title' => $request->input('title'),
            'content'=> $request->input('content'),
            'category_id'=> $request->get('postCategorySelect__updateForm'),
            'is_published' => $request->input('is_published') == "on" ? 1 : 0,
            'preview' => $url,
        ];

        $post->update($postData);
        return redirect('http://127.0.0.1:8000/adminPanel/tableWidget?posts');
    }

    protected function deletePost(Request $request) {

        $post = Post::find($request->get('selectedPostId__deleteForm'));

        if ($post != null) $post->delete();

        return redirect(session()->previousUrl());
    }
}
